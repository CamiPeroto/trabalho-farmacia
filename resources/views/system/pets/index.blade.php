@extends('templates.index')

@section('content')
    <div class="container my-5">
        <div class="row d-flex">
            <x-alert />
            <div class="col-4 my-4">
                <h3 class="fw-bold">Pets</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-6 d-flex align-items-center justify-content-start">
                <form class="d-flex justify-content-center me-5" role="search" action="{{ url('/search') }}" method="GET">
                    <div class="position-relative w-100">
                        <i class="fi fi-rr-search position-absolute"
                            style="left: 18px; top: 50%; transform: translateY(-50%); color: gray; z-index: 2;"></i>
                        <input class="form-control search-sm ps-5 me-2" type="search" placeholder="Pesquisar..."
                            aria-label="Buscar" name="q">
                    </div>
                </form>
            </div>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <a class="ms-2 text-decoration-none" href="{{ route('pets.create') }}">
                    <i class="fi fi-rr-plus-small fs-3 btn-icon-bg shadow"></i>
                </a>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-12">
                <table class="table align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>Espécie</th>
                            <th>Raça</th>
                            <th>Idade</th>
                            <th>Peso</th>
                            <th>Proprietário</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pets as $pet)
                            <tr>
                                <td>{{ $pet->name }}</td>
                                <td>{{ $pet->species->name ?? '-' }}</td>
                                <td>{{ $pet->race }}</td>
                                <td>{{ $pet->age }}</td>
                                <td>{{ $pet->weight }}</td>
                                <td>{{ $pet->client->name ?? '-' }}</td>
                                <td>
                                   <a href="{{ route('pets.edit', $pet->id) }}" class="btn btn-outline-warning btn-sm ms-2 rounded-pill">EDITAR</a>
                                    <form action="{{ route('pets.destroy', $pet->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm ms-2 rounded-pill">APAGAR</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center alert alert-danger">
                                    Nenhum pet encontrado!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <x-pagination :paginator="$pets" />
            </div>
        </div>
    </div>
@endsection