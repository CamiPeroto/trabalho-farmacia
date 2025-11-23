<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\ActiveIngredient;
use App\Models\Product;
use App\Models\Stock;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $drugstoreId = Auth::user()->drugstore_id;

        $products = Product::whereHas('stock', function ($query) use ($drugstoreId) {
            $query->where('drugstore_id', $drugstoreId);
        })->with(['stock' => function ($query) use ($drugstoreId) {
            $query->where('drugstore_id', $drugstoreId);
        }])->paginate(10);

        return view('system.products.index', ['products' => $products]);
    }

    public function create()
    {
        $ingredients = ActiveIngredient::all();
        $nextId      = \App\Models\Product::max('id') + 1;

        return view('system.products.create',
            [
                'ingredients' => $ingredients,
                'nextId'      => $nextId,
            ]);
    }
    public function show(Product $product)
    {
        $ingredients = ActiveIngredient::all();

        return view('system.products.view', ['product'=> $product,'ingredients' => $ingredients]);
    }

    public function store(ProductRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('products', 'public')
            : null;

            // Cria o remédio e armazena em $product
            $product = Product::create([
                'fantasy_name'         => $request->fantasy_name,
                'price'                => $request->price,
                'type'                 => $request->type,
                'form'                 => $request->form,
                'dosage'               => $request->dosage,
                'maker'                => $request->maker,
                'quantity'             => $request->quantity,
                'description'          => $request->description,
                'active_ingredient_id' => $request->active_ingredient_id,
                'image'                => $imagePath,
            ]);

            $drugstoreId = Auth::user()->drugstore_id;
            if (! $drugstoreId) {
            }

            // Cria automaticamente o estoque
            Log::info('Criando estoque com drugstore_id', ['drugstore_id' => $drugstoreId]);
            Stock::create([
                'product_id'     => $product->id,
                'quantity'        => $product->quantity,
                'unitary_price'   => $product->price,
                'entry_date'      => Carbon::now()->toDateString(),
                'expiration_date' => Carbon::now()->addYears(2)->toDateString(),
                'drugstore_id'    => $drugstoreId,
            ]);

            DB::commit();

            return redirect()->route('product.index')
                ->with('success', 'Remédio cadastrado com sucesso!');

        } catch (Exception $e) {
            DB::rollBack();
            Log::notice('Remédio não cadastrado.', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Remédio não cadastrado');
        }
    }

    public function edit(Product $product)
    {
        $ingredients = ActiveIngredient::all();
        return view('system.products.edit', ['product' => $product, 'ingredients' => $ingredients]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            // Se houver nova imagem, armazena e exclui a antiga
            if ($request->hasFile('image')) {
                // Exclui imagem antiga, se existir
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }

                $imagePath = $request->file('image')->store('products', 'public');
            } else {
                $imagePath = $product->image; // mantém a imagem atual
            }

            // Atualiza os dados
            $product->update([
                'fantasy_name'         => $request->fantasy_name,
                'price'                => $request->price,
                'type'                 => $request->type,
                'form'                 => $request->form,
                'dosage'               => $request->dosage,
                'maker'                => $request->maker,
                'description'          => $request->description,
                'active_ingredient_id' => $request->active_ingredient_id,
                'image'                => $imagePath,
            ]);

            DB::commit();

            return redirect()->route('product.index')
                ->with('success', 'Remédio atualizado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar remédio.', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Erro ao atualizar o remédio.');
        }
    }
    public function destroy(Product $product)
    {

        try {

            $totalStock = $product->stock()->count();

            // Estoques que são inativos e com quantidade < 3
            $deletableStock = $product->stock()
                ->where('status', false)
                ->where('quantity', '<', 3)
                ->count();

            // Se houver algum estoque que não é seguro, bloqueia
            if ($deletableStock !== $totalStock) {
                return redirect()->route('product.index')
                    ->with('error', 'Remédio não foi excluído! Estoque ativo ou com quantidade suficiente.');
            }

            // Exclui todos os estoques restantes
            $product->stock()->delete();
            $product->delete();

            Log::info('Remédio apagado.', ['product' => $product->id]);

            return redirect()->route('product.index')->with('success', 'Remédio excluído com sucesso!');

        } catch (Exception $e) {

            Log::info('Remédio não apagado.', ['error' => $e->getMessage()]);

            return redirect()->route('product.index')
                ->with('error', 'Remédio não foi excluído!');

        }

    }

}
