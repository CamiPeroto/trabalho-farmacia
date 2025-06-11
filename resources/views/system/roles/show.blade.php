@extends('templates.index')

 @section('content')

    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Papel</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                     <a href="{{ route('permission.index') }}" class= "text-decoration-none">Permissões</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('role.index') }}" class= "text-decoration-none">Papéis</a>
                </li>
                <li class="breadcrumb-item active">Papel</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span >Visualizar</span>
                
                <span class="ms-auto d-sm-flex flex-row">
                   
                    @can('index-role')
                     <a href="{{route('role.index')}}" 
                    class=" btn btn-info btn-sm me-1 mb-1 mb-sm-0"> <i class="fa-solid fa-list"></i> Papéis </a>
                     @endcan   
                    @can('edit-role')
                         <a href="{{ route('role.edit', ['role' => $role->id]) }}" 
                         class=" btn btn-warning btn-sm me-1 mb-1 mb-sm-0"><i class="fa-regular fa-pen-to-square"></i> Editar </a>
                     @endcan
                    @can('destroy-role')
                         <form action="{{ route('role.destroy', ['role' => $role->id]) }}" method="POST">
                             @csrf
                             @method('delete')
                             <button type="submit" class="btn btn-danger btn-sm me-1" onclick="return confirm('Tem certeza que deseja apagar o registro ?')"><i class="fa-regular fa-square-minus"></i> Apagar</button>
                         </form>  
                     @endcan          
                </span>
            </div>

            <div class="card-body">
                
                <x-alert />
                
                <dl class="row">
                    <dt class="col-sm-3">ID: </dt>
                    <dd class="col-sm-9">{{$role->id}}</dd>
                    
                    <dt class="col-sm-3">Nome: </dt>
                    <dd class="col-sm-9">{{$role->name}}</dd>

                </dl>
            </div>
        </div>
    </div>
    
@endsection
    
 
