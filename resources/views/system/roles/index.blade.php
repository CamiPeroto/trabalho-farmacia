@extends('templates.index')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3 ms-5">Papel</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('permission.index') }}" class= "text-decoration-none">Permissões</a>
                </li>
                <li class="breadcrumb-item active">Papéis</li>
            </ol>
        </div>

        <div class="card mb-5 border-light shadow mx-5 pb-5">
            <div class="card-header hstack">
                <span class="ms-auto">
                    @can('create-role')
                        <a href="{{ route('role.create') }}"
                            class="btn btn-light rounded-circle shadow d-flex align-items-center justify-content-center"
                            id="white-circle" style="width: 48px; height: 48px;">
                            <img src="{{ asset('assets/img/add-icon.png') }}" alt="+" style="width: 12px; height: 12px;">
                        </a>
                    @endcan
                </span>
            </div>

            <div class="card-body mx-4">
                <x-alert />
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">ID</th>
                            <th>Nome</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- imprimir os registros --}}
                        @forelse ($roles as $role)
                            <tr>
                                <th class="d-none d-sm-table-cell">{{ $role->id }}</th>
                                <td>{{ $role->name }}</td>

                                <td class="d-md-flex flex-row justify-content-center">

                                    @can('index-role-permission')
                                        <a href="{{ route('role-permission.index', ['role' => $role->id]) }}"
                                            class="btn btn-outline-info btn-sm rounded-pill me-1 mb-1 mb-md-0"> <i
                                                class="fa-solid fa-list"></i> Permissões </a>
                                    @endcan
                                    @can('edit-role')
                                        <a href="{{ route('role.edit', ['role' => $role->id]) }}"
                                            class="btn btn-outline-warning btn-sm rounded-pill me-1 mb-1 mb-md-0"> <i
                                                class="fa-regular fa-pen-to-square"></i> Editar </a>
                                    @endcan
                                    @can('destroy-role')
                                        <form action="{{ route('role.destroy', ['role' => $role->id]) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill me-1"
                                                onclick="return confirm('Tem certeza que deseja apagar o registro ?')"><i
                                                    class="fa-regular fa-square-minus"></i> Apagar</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum papel encontrado!
                            </div>
                        @endforelse
                    </tbody>
                </table>

              <x-pagination :paginator="$roles" />

            </div>
        </div>
    </div>
@endsection
