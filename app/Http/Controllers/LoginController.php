<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class LoginController extends Controller
{
    public function index()
    {
        return view('system.login.index');
    }

    public function loginProcess(LoginRequest $request)
    {
        //Validar o formulário
        $request->validated();

        //Validar usuário e senha com as informações do banco
        $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if (! $authenticated) {
            //Redirecionar o usuário para a página anterior 'login', enviar mensagem de erro
            return back()->withInput()->with('error', 'Email ou senha inválidos!');
        }

        //Obter o usuário autenticado
        $user = Auth::user();
        $user = User::find($user->id);
        //Verificar se a permissão é super-admin, acesso a todas as páginas
        if ($user->hasRole('Super Admin')) {
            //O usuário tem todas as permissões
            $permissions = Permission::pluck('name')->toArray();

        } else {
            //Recuperar no banco as permissões que o papel possui
            $permissions = $user->getPermissionsViaRoles()->pluck('name')
                ->toArray();
        }
        //Atribuir as permissões ao usuário
        $user->syncPermissions($permissions);
        
        if ($user->hasRole('Cliente')) {
            return redirect('/'); 
        }

        return redirect()->route('medicine.index');

    }

    //Carregar o formulário cadastrar novo usuário
    public function create()
    {
        return view('login.create');
    }

    //Cadastrar o novo usuário no banco
    public function store(LoginUserRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            //cadastrar na tabela usuários
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password,
            ]);
            //Cadastrar um papel para o usuário
            $user->assignRole('Cliente');
            // Salvar log
            Log::info('Usuário cadastrado.', ['id' => $user->id]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('login.index')->with('success', 'Usuário cadastrado com sucesso!');

        } catch (Exception $e) {

            // Salvar log
            Log::info('Usuário não cadastrado.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }

    }
    //Deslogar o usuário
    public function destroy()
    {
        //Deslogar o usuário
        Auth::logout();
        //Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('login.index')->with('success', 'Deslogado com sucesso!');
    }
}
