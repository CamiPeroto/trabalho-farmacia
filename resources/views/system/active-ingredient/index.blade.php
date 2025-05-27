@extends('templates.index')


@section('content')
    <div class="container my-5">
        <div class="row d-flex">
            <div class="col-6 my-4">
                <h3 class="fw-bold">Princípio Ativo</h3>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-end">
                <form class="d-flex justify-content-center me-5" role="search" action="{{ url('/search') }}" method="GET">
                    <input class="form-control search-sm me-2" type="search" placeholder="Pesquisar..." aria-label="Buscar"
                        name="q">
                </form>
            </div>
            <div class="col-3 d-flex align-items-center justify-content-start gap-3">
                <p>Filtros</p>
                <i class="fi fi-rr-bars-filter"></i>
            </div>
            <div class="col-3 d-flex align-items-center justify-content-start gap-3">
                <p>Exportar</p>
                <i class="fi fi-rr-download"></i>
            </div>

            <div class="col-6 my-4 d-flex justify-content-end">
                <button type="button" class="btn btn-light rounded-circle shadow" id="white-circle">
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table custom-table shadow">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>John</td>
                            <td>Doe</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="line mt-5"></div>
@endsection
