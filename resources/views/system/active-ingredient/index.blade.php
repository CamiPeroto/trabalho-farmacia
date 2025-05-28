@extends('templates.index')


@section('content')
    <div class="container my-5">
        <div class="row d-flex">
            <div class="col-6 my-4">
                <h3 class="fw-bold">Princípio Ativo</h3>
            </div>
            <div class="row">
                <div class="col-6 d-flex align-items-center justify-content-start">
                    <form class="d-flex justify-content-center me-5" role="search" action="{{ url('/search') }}"
                        method="GET">
                        <div class="position-relative w-100">
                            <i class="fi fi-rr-search position-absolute"
                                style="left: 18px; top: 50%; transform: translateY(-50%); color: gray; z-index: 2;"></i>
                            <input class="form-control search-sm ps-5 me-2" type="search" placeholder="Pesquisar..."
                                aria-label="Buscar" name="q">
                        </div>
                    </form>
                </div>
                <div class="col-6 my-4 d-flex justify-content-end">
                <a href="{{ route('active-ingredient.create') }}"
                    class="btn btn-light rounded-circle shadow d-flex align-items-center justify-content-center"
                    id="white-circle" style="width: 48px; height: 48px;">
                    <img src="{{ asset('assets/img/add-icon.png') }}" alt="+" style="width: 12px; height: 12px;">
                </a>
            </div>
            </div>
            <div class="col-3 d-flex align-items-end justify-content-start gap-3 my-3" id="action-item">
                <p class="mb-0 fs-6 fw-bold">Filtros</p>
                <i class="fi fi-rr-bars-filter"></i>
            </div>
            <div class="col-3 d-flex align-items-end mb-2 justify-content-start gap-3">
                <p class="mb-0 fs-6 fw-bold">Exportar</p>
                <i class="fi fi-rr-download"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table custom-table table-hover">
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
                    <tfoot>
                        <tr style="height: 7vh;">
                            <td colspan="3"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="line mt-5"></div>
@endsection
