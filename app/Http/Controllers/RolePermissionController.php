<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index(Role $role)
    {
        //Verificae se tem papel de super admin, não permitir visualizar as permissões
        if($role->name=='Super Admin'){
            //Salvar log
            Log::info('Permissões do super admin não pode ser acessada', ['action_user_id' => Auth::id()]);

            //redirecionar o usuário e enviar mensagem de erro
            return redirect()->route('role.index')->with('error', 'As permissões do super admin não podem ser acessadas!');
         }

         //Recuperar as permissões
        $rolePermissions =  DB::table('role_has_permissions')
            ->where('role_id', $role->id)
            ->pluck('permission_id')
            ->all();
        //Recuperar todas as permissões do banco de dados 
       $permissions = Permission::get();

       Log::info('Listar permissões do papel', ['role_id' => $role->id, 'action_user_id' => Auth::id()]);
       //Carregar a view
       return view('system.rolePermission.index', [
        'menu' => 'roles',
        'rolePermissions' => $rolePermissions,
        'permissions' => $permissions,
        'role' => $role,
       ]);
    }

    public function update (Request $request, Role $role)
    {
        //Obter a permissão específica com base no ID fornecido em $request->permission
        $permission = Permission::find($request->permission);
        //Verificar se a permissão foi encontrada
        if(!$permission){
            
            //Salvar log
            Log::info('Permissão não encontrada', ['role' =>$role->id, 'permission' => 
            $request->permission, 'action_user_id' => Auth::id()]);

            //redirecionar o usuário e enviar mensagem de erro
            return redirect()->route('role-permission.update', ['role' =>$role->id, 'permission' => $request->permission])
            ->with('error', 'Permissão não encontrada!');

        }

        //Verificar se a permissão já está associada ao papel
        if($role->permissions->contains($permission)){
            //remover a permissão (bloquear)
            $role->revokePermissionTo($permission);
            //Salvar log
            Log::info('Bloquear permissão para o papel', ['action_user_id' => Auth::id(), 'permissao' => $request->permission]);
           
            //redirecionar o usuário e enviar mensagem de sucesso
              return redirect()->route('role-permission.index', ['role' =>$role->id])
              ->with('success', 'Permissão bloqueada com sucesso!');
        }else{
            $role->givePermissionTo($permission);

               //Salvar log
               Log::info('Liberar permissão para o papel', ['action_user_id' => Auth::id(), 'permissao' => $request->permission]);
              
               //redirecionar o usuário e enviar mensagem de sucesso
                 return redirect()->route('role-permission.index', ['role' => $role->id])
                 ->with('success', 'Permissão liberada com sucesso!');
        }

    }
}
