@extends('templates.index')

 @section('content')

    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Editar</h2>

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
                <span >Editar</span>
                <span class="ms-auto d-sm-flex flex-row">      
                    <a href="{{route('role.index') }}"class=" btn btn-info btn-sm me-1 mb-1 mb-sm-0"><i class="fa-solid fa-list"></i> Listar </a>
                    {{-- <a href="{{ route('role.show', ['role' =>$role->id]) }}"class=" btn btn-info btn-sm me-1 mb-1 mb-sm-0"> <i class="fa-regular fa-eye"></i> Visualizar </a> --}}
                </span>
            </div>
            <div class="card-body">  
                <x-alert />

                <form class="row g-3" action="{{route('role.update', ['role'=> $role->id]) }}" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="col-12">
                     <label for="Nome" class="form-label">Papel</label>
                     <input type="text" name="name" class="form-control" id="name" placeholder="Nome do Papel" value="{{old('name', $role->name)}}" required>
                   </div>
                   @can('edit-role')
                    <div class="col-12">
                        <button type="submit" class="btn btn-warning btn-sm">Salvar</button>
                    </div>
                   @endcan
                </form>
            </div>
        </div>
    </div>
    
@endsection
    
 
