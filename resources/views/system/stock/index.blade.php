@extends('templates.index')


@section('content')
    @php
        $products = [
            [
                'title' => 'Dipirona Monoidratada 1g - CIMED',
                'description' => '10 comprimidos',
                'price' => 13.12,
                'stock' => 150,
                'image' =>
                    'https://airela.com.br/wp-content/uploads/2024/02/ibuprofeno_400mg_ibuprofeno_10capsulas.png',
            ],
            [
                'title' => 'Rivotril 0,5 mg Tablet - Clonazepam',
                'description' => '100 Tablets',
                'price' => 33.25,
                'stock' => 0,
                'image' =>
                    'https://dmvfarma.vtexassets.com/arquivos/ids/271865/DIPIRONA%20500MG%20C20.png.png?v=638827583361130000',
            ],
            [
                'title' => 'Dipirona Monoidratada 1g - CIMED',
                'description' => '10 comprimidos',
                'price' => 13.12,
                'stock' => 150,
                'image' =>
                    'https://airela.com.br/wp-content/uploads/2024/02/ibuprofeno_400mg_ibuprofeno_10capsulas.png',
            ],
            [
                'title' => 'Rivotril 0,5 mg Tablet - Clonazepam',
                'description' => '100 Tablets',
                'price' => 33.25,
                'stock' => 0,
                'image' =>
                    'https://dmvfarma.vtexassets.com/arquivos/ids/271865/DIPIRONA%20500MG%20C20.png.png?v=638827583361130000',
            ],
            [
                'title' => 'Dipirona Monoidratada 1g - CIMED',
                'description' => '10 comprimidos',
                'price' => 13.12,
                'stock' => 150,
                'image' =>
                    'https://airela.com.br/wp-content/uploads/2024/02/ibuprofeno_400mg_ibuprofeno_10capsulas.png',
            ],
            [
                'title' => 'Rivotril 0,5 mg Tablet - Clonazepam',
                'description' => '100 Tablets',
                'price' => 33.25,
                'stock' => 0,
                'image' =>
                    'https://dmvfarma.vtexassets.com/arquivos/ids/271865/DIPIRONA%20500MG%20C20.png.png?v=638827583361130000',
            ],
            [
                'title' => 'Dipirona Monoidratada 1g - CIMED',
                'description' => '10 comprimidos',
                'price' => 13.12,
                'stock' => 150,
                'image' =>
                    'https://airela.com.br/wp-content/uploads/2024/02/ibuprofeno_400mg_ibuprofeno_10capsulas.png',
            ],
            [
                'title' => 'Rivotril 0,5 mg Tablet - Clonazepam',
                'description' => '100 Tablets',
                'price' => 33.25,
                'stock' => 0,
                'image' =>
                    'https://dmvfarma.vtexassets.com/arquivos/ids/271865/DIPIRONA%20500MG%20C20.png.png?v=638827583361130000',
            ],
        ];

    @endphp
    <div class="container my-5">
        <div class="row d-flex">
            <div class="col-4 my-4 ps-5">
                <h3 class="fw-bold ps-5">Estoque de Produtos</h3>
            </div>
            <div class="col-4 d-flex align-items-center">
                <div class="form-check form-check-inline ms-5 mt-2">
                    <input class="form-check-input" type="checkbox" id="todosCheckbox" name="filter[]" value="todos"
                        checked>
                    <label class="form-check-label" for="todosCheckbox">Todos</label>
                </div>
                <div class="form-check form-check-inline mt-2">
                    <input class="form-check-input" type="checkbox" id="ativoCheckbox" name="filter[]" value="ativo">
                    <label class="form-check-label" for="ativoCheckbox">Princípio Ativo</label>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center justify-content-end">
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
        </div>
        <div class="row">
            <div class="col-6 ps-5">
                <div class="dropdown ps-5">
                    <button class="btn btn-secondary dropdown-toggle d-flex align-items-center gap-2" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="icon-dropdown me-3">
                            <i class="fi fi-rr-menu-burger d-flex align-items-center fs-4"></i>
                        </div>
                        <div class="text-start">
                            <div class="fw-bold">Filiais</div>
                            <small class="text-dark">Ponta Grossa</small>
                        </div>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Ponta Grossa</a></li>
                        <li><a class="dropdown-item" href="#">Curitiba</a></li>
                        <li><a class="dropdown-item" href="#">Londrina</a></li>
                        <li><a class="dropdown-item" href="#">Maringá</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <a class="ms-2 text-decoration-none" href="{{ url('/medicines') }}">
                    <i class="fi fi-rr-plus-small fs-3 btn-icon-bg"></i>
                </a>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-12">
                <table class="table align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th class="text-start">Produtos</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr style="--bs-table-bg: {{ $loop->index % 2 == 0 ? '#0252590D' : '#00717226' }}">
                                <td class="d-flex align-items-center text-start">
                                    <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" width="150"
                                        height="150" class="me-3">
                                    <div>
                                        <strong>{{ $product['title'] }}</strong><br>
                                        <small>{{ $product['description'] }}</small>
                                    </div>
                                </td>
                                <td class="fw-bold">R$ {{ number_format($product['price'], 2, ',', '.') }}</td>
                                <td>{{ $product['stock'] }}</td>
                                <td>
                                    @if ($product['stock'] > 0)
                                        <span class="badge bg-success px-3 py-2 rounded-pill">ATIVO</span>
                                    @else
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">INATIVO</span>
                                    @endif
                                    <a href="#" class="btn btn-outline-dark btn-sm ms-2 rounded-pill">EDITAR</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const todosCheckbox = document.getElementById('todosCheckbox');
            const ativoCheckbox = document.getElementById('ativoCheckbox');
            const allRows = document.querySelectorAll('tbody tr');

            function updateTable() {
                allRows.forEach(row => {
                    const statusBadge = row.querySelector('.badge');
                    const isAtivo = statusBadge && statusBadge.textContent.trim() === 'ATIVO';

                    if (ativoCheckbox.checked && !todosCheckbox.checked) {
                        row.style.display = isAtivo ? '' : 'none';
                    } else {
                        row.style.display = '';
                    }
                });
            }

            todosCheckbox.addEventListener('change', () => {
                if (todosCheckbox.checked) {
                    ativoCheckbox.checked = false;
                }
                updateTable();
            });

            ativoCheckbox.addEventListener('change', () => {
                if (ativoCheckbox.checked) {
                    todosCheckbox.checked = false;
                } else {
                    todosCheckbox.checked = true;
                }
                updateTable();
            });

            updateTable();
        });
    </script>
@endsection
