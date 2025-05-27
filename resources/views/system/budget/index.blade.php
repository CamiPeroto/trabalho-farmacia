@extends('templates.index')


@section('content')
    <div class="container my-5">
        <div class="row d-flex">
            <div class="col-6 my-4">
                <h3 class="fw-bold">Orçamento com Fornecedores</h3>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-end">
                <form class="d-flex justify-content-center me-5" role="search" action="{{ url('/search') }}"
                    method="GET">
                    <input class="form-control search-sm me-2" type="search" placeholder="Pesquisar..." aria-label="Buscar"
                        name="q">
                </form>
            </div>
            <h5 class="my-4">Resultados da Pesquisa...</h5>
        </div>
        <div class="container d-flex">
            <div class="col-3">
                <div class="card shadow" style="width: 21rem;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                    </div>
                    <img src="https://dmvfarma.vtexassets.com/arquivos/ids/271865/DIPIRONA%20500MG%20C20.png.png?v=638827583361130000"
                        class="card-img-top" alt="..." style="width: 100%;">
                    <div class="card-body d-flex align-items-end gap-3">
                        <p class="fw-bold mb-0" id="p-price">R$:5.00/unt</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item rounded">Comprar</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card shadow" style="width: 21rem;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                    </div>
                    <img src="https://airela.com.br/wp-content/uploads/2024/02/ibuprofeno_400mg_ibuprofeno_10capsulas.png"
                        class="card-img-top" alt="..." style="width: 80%;">
                    <div class="card-body d-flex  align-items-end gap-3">
                        <p class="fw-bold" id="p-price">R$:5.00/unt</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item rounded">Comprar</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card shadow" style="width: 21rem;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                    </div>
                    <img src="https://dmvfarma.vtexassets.com/arquivos/ids/271865/DIPIRONA%20500MG%20C20.png.png?v=638827583361130000"
                        class="card-img-top" alt="...">
                    <div class="card-body d-flex  align-items-end gap-3">
                        <p class="fw-bold" id="p-price">R$:5.00/unt</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item rounded">Comprar</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card shadow" style="width: 21rem;">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                    </div>
                    <img src="https://airela.com.br/wp-content/uploads/2024/02/ibuprofeno_400mg_ibuprofeno_10capsulas.png"
                        class="card-img-top" alt="..." style="width: 80%;">

                    <div class="card-body d-flex  align-items-end gap-3">
                        <p class="fw-bold" id="p-price">R$:5.00/unt</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item rounded">Comprar</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
