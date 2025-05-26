@extends('templates.index')


@section('content')
    <div class="container my-5">
        <div class="row d-flex">
            <div class="col-12 my-4 d-flex">
                <h3 class="fw-bold">Orçamento com Fornecedores</h3>
                <form class="d-flex flex-grow-1 justify-content-center" role="search" action="{{ url('/search') }}"
                    method="GET">
                    <input class="form-control search-sm me-2" type="search" placeholder="Pesquisar..."
                        aria-label="Buscar" name="q">
                </form>
            </div>

        </div>
        <div class="container d-flex">
            <div class="col-3">
                <div class="card" style="width: 21rem;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                    </div>
                    <img src="https://dmvfarma.vtexassets.com/arquivos/ids/271865/DIPIRONA%20500MG%20C20.png.png?v=638827583361130000"
                        class="card-img-top" alt="..." style="width: 100%;">
                    <div class="card-body d-flex  align-items-end gap-3">
                        <p class="fw-bold">R$:5.00/unt</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item rounded">Comprar</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" style="width: 21rem;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                    </div>
                    <img src="https://airela.com.br/wp-content/uploads/2024/02/ibuprofeno_400mg_ibuprofeno_10capsulas.png"
                        class="card-img-top" alt="..." style="width: 80%;">
                    <div class="card-body d-flex  align-items-end gap-3">
                        <p class="fw-bold">R$:5.00/unt</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item rounded">Comprar</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" style="width: 21rem;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                    </div>
                    <img src="https://dmvfarma.vtexassets.com/arquivos/ids/271865/DIPIRONA%20500MG%20C20.png.png?v=638827583361130000"
                        class="card-img-top" alt="...">
                    <div class="card-body d-flex  align-items-end gap-3">
                        <p class="fw-bold">R$:5.00/unt</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item rounded">Comprar</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" style="width: 21rem;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                    </div>
                    <img src="https://airela.com.br/wp-content/uploads/2024/02/ibuprofeno_400mg_ibuprofeno_10capsulas.png"
                        class="card-img-top" alt="..." style="width: 80%;">

                    <div class="card-body d-flex  align-items-end gap-3">
                        <p class="fw-bold">R$:5.00/unt</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item rounded">Comprar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
