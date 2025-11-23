<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Species;
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
        $branchId = Auth::user()->branch_id;

        $products = Product::whereHas('stock', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })->with(['stock' => function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        }])->paginate(10);

        return view('system.products.index', ['products' => $products]);
    }

    public function create()
    {
        $species = Species::all();
        $nextId      = \App\Models\Product::max('id') + 1;

        return view('system.products.create',
            [
                'species' => $species,
                'nextId'      => $nextId,
            ]);
    }
    public function show(Product $product)
    {
        $species = Species::all();

        return view('system.products.view', ['product'=> $product,'species' => $species]);
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
                'name'                 => $request->name,
                'price'                => $request->price,
                'type'                 => $request->type,
                'shape'                => $request->shape,
                'weight'               => $request->weight,
                'maker'                => $request->maker,
                'quantity'             => $request->quantity,
                'species_id'           => $request->species_id,
                'image'                => $imagePath,
            ]);

            $branchId = Auth::user()->branch_id;

            // Cria automaticamente o estoque
            Log::info('Criando estoque com branch_id', ['branch_id' => $branchId]);
            Stock::create([
                'product_id'     => $product->id,
                'quantity'        => $product->quantity,
                'unitary_price'   => $product->price,
                'entry_date'      => Carbon::now()->toDateString(),
                'expiration_date' => Carbon::now()->addYears(2)->toDateString(),
                'branch_id'    => $branchId,
            ]);

            DB::commit();

            return redirect()->route('products.index')
                ->with('success', 'Produto cadastrado com sucesso!');

        } catch (Exception $e) {
            DB::rollBack();
            Log::notice('Produto não cadastrado.', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Produto não cadastrado');
        }
    }

    public function edit(Product $product)
    {
        $species = Species::all();
        return view('system.products.edit', ['product' => $product, 'species' => $species]);
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
                'name'                 => $request->name,
                'price'                => $request->price,
                'type'                 => $request->type,
                'shape'                => $request->shape,
                'weight'               => $request->weight,
                'maker'                => $request->maker,
                'quantity'             => $request->quantity,
                'species_id'           => $request->species_id,
                'image'                => $imagePath,
            ]);

            DB::commit();

            return redirect()->route('products.index')
                ->with('success', 'Produto atualizado com sucesso!');
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
                ->where('quantity', '<=', 3)
                ->count();

            // Se houver algum estoque que não é seguro, bloqueia
            if ($deletableStock !== $totalStock) {
                return redirect()->route('products.index')
                    ->with('error', 'Produto não foi excluído! Estoque ativo ou com quantidade suficiente.');
            }

            // Exclui todos os estoques restantes
            $product->stock()->delete();
            $product->delete();

            Log::info('Produto apagado.', ['product' => $product->id]);

            return redirect()->route('products.index')->with('success', 'Produto excluído com sucesso!');

        } catch (Exception $e) {

            Log::info('Produto não apagado.', ['error' => $e->getMessage()]);

            return redirect()->route('products.index')
                ->with('error', 'Produto não foi excluído!');

        }

    }

}
