@extends('templates.index')

@section('content')
    <div class="container-fluid px-4 pt-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3 ms-5"> Permissões por Páginas</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('permission.index') }}" class="text-decoration-none">Permissões</a>
                </li>
                <li class="breadcrumb-item active">Páginas</li>
            </ol>
        </div>

        <div class="card mb-4 mt-2 border-light shadow mx-5">
            <div class="card-body mx-4">
                <form action="{{ route('permission.index') }}">
                    {{-- <form action="#"> --}}
                    <div class="row">

                        <div class="col-md-4 col-sm-12">
                            <label for="name" class="form-label">Titulo</label>
                            <input type="text" name="title" class="form-control" id="title"
                                value="{{ $title }}" placeholder="Título">
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <label for="name" class="form-label">Nome da Página</label>
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ $name }}" placeholder="Nome da página">
                        </div>

                        <div class="col-md-4 col-sm-12 mt-3 pt-3">
                            <button type="submit" class="btn btn-outline-info rounded-pill btn-md"><i
                                    class="fa-solid fa-magnifying-glass"></i>
                                Pesquisar</button>
                            <a href=" {{ route('permission.index') }}"
                                class="btn btn-outline-warning btn-md rounded-pill"><i class="fa-solid fa-trash"></i>
                                Limpar</a>
                        </div>

                    </div>

                </form>
            </div>
        </div>

        <div class="card mb-4 border-light shadow mx-5">

            <div class="card-header hstack gap-2">
                <span class="ms-auto">
                    @can('create-permission')
                        <a href="{{ route('permission.create') }}"
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
                            <th>ID</th>
                            <th class="d-none d-md-table-cell">Título</th>
                            <th>Nome</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody cl>

                        {{-- Imprimir os registros --}}
                        @forelse ($permissions as $permission)
                            <tr>
                                <th>{{ $permission->id }}</th>
                                <td class="d-none d-md-table-cell">{{ $permission->title }}</td>
                                <td>{{ $permission->name }}</td>
                                <td class="d-md-flex flex-row justify-content-center">

                                    @can('show-permission')
                                        <a href="{{ route('permission.show', ['permission' => $permission->id]) }}"
                                            class="btn btn-outline-info rounded-pill btn-sm me-1 mb-1 mb-md-0"><i
                                                class="fa-regular fa-eye"></i>
                                            Visualizar</a>
                                    @endcan

                                    @can('edit-permission')
                                        <a href="{{ route('permission.edit', ['permission' => $permission->id]) }}"
                                            class="btn btn-outline-warning rounded-pill btn-sm me-1 mb-1 mb-md-0"><i
                                                class="fa-regular fa-pen-to-square"></i> Editar</a>
                                    @endcan

                                    @can('destroy-permission')
                                        <form action="{{ route('permission.destroy', ['permission' => $permission->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill me-1"
                                                onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i
                                                    class="fa-regular fa-trash-can"></i> Apagar</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhuma permissão encontrada!
                            </div>
                        @endforelse

                    </tbody>
                </table>
                <x-pagination :paginator="$permissions" />
            </div>
        </div>
    </div>
@endsection
