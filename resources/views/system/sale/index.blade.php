@extends('templates.index')


@section('content')
    @php
        $products = [
            [
                'title' => 'Dipirona Monoidratada 1g - CIMED',
                'description' => '10 comprimidos',
                'price' => 13.12,
                'quantity' => 1,
                'image' =>
                    'https://airela.com.br/wp-content/uploads/2024/02/ibuprofeno_400mg_ibuprofeno_10capsulas.png',
            ],
            [
                'title' => 'Rivotril 0,5 mg Tablet - Clonazepam',
                'description' => '100 Tablets',
                'price' => 33.25,
                'quantity' => 2,
                'image' =>
                    'https://dmvfarma.vtexassets.com/arquivos/ids/271865/DIPIRONA%20500MG%20C20.png.png?v=638827583361130000',
            ],
            [
                'title' => 'Dipirona Monoidratada 1g - CIMED',
                'description' => '10 comprimidos',
                'price' => 13.12,
                'quantity' => 1,
                'image' =>
                    'https://airela.com.br/wp-content/uploads/2024/02/ibuprofeno_400mg_ibuprofeno_10capsulas.png',
            ],
        ];

    @endphp
    <div class="container my-5">
        <div class="row d-flex">
            <div class="col-4 my-4">
                <h3 class="fw-bold">Venda de Produtos</h3>
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
                <a class="ms-2 text-decoration-none" href="{{ url('/medicines') }}">
                    <i class="fi fi-rr-plus-small fs-3 btn-icon-bg shadow"></i>
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
                            <th>Quantidade</th>
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
                                <td>
                                    <div
                                        class="d-inline-flex border  border-black rounded-pill overflow-hidden align-items-center">
                                        <button class="btn btn-sm px-3 border-end" type="button"
                                            onclick="decrementQuantity(this)">−</button>
                                        <span class="px-3 text-center fw-bold" style="min-width: 40px;"
                                            data-quantity>1</span>
                                        <button class="btn btn-sm px-3 border-start" type="button"
                                            onclick="incrementQuantity(this)">+</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @php
                            $totalBg = count($products) % 2 == 0 ? '#0252590D' : '#00717226';
                        @endphp

                        <tr style="--bs-table-bg: {{ $totalBg }};">
                            <td colspan="2" class="fw-bold text-end py-5"
                                style="font-size: 1.25rem; padding-right: 5rem;">
                                Total:
                            </td>
                            <td class="fw-bold" style="font-size: 1.25rem;">
                                <span class="p-3 badge badge-total rounded-pill text-bg-dark fs-5 shadow">123,45</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="cpf" class="form-label">CPF do Cliente</label>
                <input type="text" class="form-control input-bg" id="cpf" placeholder="000.000.000-00">
            </div>
        </div>
        <div class="col-12 d-flex justify-content-end gap-3" style="">
            <button type="submit" class="btn btn-warning rounded-5 fw-medium" id="cancel-sale">Cancelar</button>
            <button type="submit" class="btn btn-warning rounded-5" id="sale-button">Finalizar Venda</button>
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
