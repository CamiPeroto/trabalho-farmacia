@extends('templates.index')


@section('content')
    <div class="container my-5">
        <div class="row d-flex">
            <div class="col-4 my-4">
                <h3 class="fw-bold ">Estoque de Produtos</h3>
            </div>
            <div class="col-4 d-flex align-items-center">
                <div class="form-check form-check-inline ms-5 mt-2">
                    <input class="form-check-input" type="checkbox" id="todosCheckbox" name="filter[]" value="todos" checked>
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
            <div class="col-6">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle d-flex align-items-center gap-2" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="icon-dropdown me-3">
                            <i class="fi fi-rr-menu-burger d-flex align-items-center fs-4"></i>
                        </div>
                        <div class="text-start">
                            <div class="fw-bold">Filiais</div>
                            <small class="text-dark">Selecionar: </small>
                        </div>
                    </button>
                    <ul class="dropdown-menu">
                        @foreach ($drugstores as $drugstore)
                            <li>
                                <a class="dropdown-item" href="{{ route('stock.index', ['drugstore' => $drugstore->id]) }}">
                                    {{ $drugstore->name }}
                                </a>
                            </li>
                        @endforeach
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
                            <th>Filial</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $stock)
                            <tr style="--bs-table-bg: {{ $loop->index % 2 == 0 ? '#0252590D' : '#00717226' }}">
                                <td class="d-flex align-items-center text-start">
                                    <img src="{{ $stock->medicine->image ? (Str::startsWith($stock->medicine->image, 'assets') ? asset($stock->medicine->image) : asset('storage/' . $stock->medicine->image)) : 'https://via.placeholder.com/150' }}"
                                        alt="{{ $stock->medicine->fantasy_name }}" width="120" height="120"
                                        class="me-3 rounded my-3" style="cursor: pointer;">
                                    <div>
                                        <strong>{{ $stock->medicine->fantasy_name ?? 'Sem nome' }}</strong><br>

                                        @if ($stock->quantity < 20)
                                            <span class="badge bg-danger mt-2 d-inline-flex align-items-center p-2">
                                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                                <small>Estoque mínimo!</small>
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <td class="fw-bold">R$ {{ number_format($stock->medicine->price ?? 0, 2, ',', '.') }}</td>
                                <td>{{ $stock->quantity }}</td>
                                <td>{{ $stock->drugstore->name ?? 'N/A' }}</td>
                                <td>
                                    @if ($stock->status)
                                        <span class="badge bg-success px-3 py-2 rounded-pill">ATIVO</span>
                                    @else
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">INATIVO</span>
                                    @endif
                                    <a href="{{ route('stock.edit', $stock->id) }}"
                                        class="btn btn-outline-dark btn-sm ms-2 rounded-pill">EDITAR</a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <x-pagination :paginator="$stocks" />
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
