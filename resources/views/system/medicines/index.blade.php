@extends('templates.index')


@section('content')
    <div class="container my-5">
        <div class="row d-flex">
            <div class="col-4 my-4">
                <h3 class="fw-bold">Produtos</h3>
            </div>
        </div>
        <x-alert />
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
            <div class="col-6 my-4 d-flex justify-content-end">
                <a href="{{ route('medicine.create') }}"
                    class="btn btn-light rounded-circle shadow d-flex align-items-center justify-content-center"
                    id="white-circle" style="width: 48px; height: 48px;">
                    <img src="{{ asset('assets/img/add-icon.png') }}" alt="+" style="width: 12px; height: 12px;">
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
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medicines as $medicine)
                            <tr>
                                <td class="d-flex align-items-center text-start">
                                    <img src="{{ $medicine->image ? asset('storage/' . $medicine->image) : 'https://via.placeholder.com/150' }}"
                                        alt="{{ $medicine->fantasy_name }}" width="150" height="150"
                                        class="me-3 rounded">
                                    <div>
                                        <strong>{{ $medicine->fantasy_name }}</strong><br>
                                        <small>{{ $medicine->description ?? 'Sem descrição' }}</small>
                                    </div>
                                </td>
                                <td class="fw-bold">R$ {{ number_format($medicine->price, 2, ',', '.') }}</td>
                                <td>{{ $medicine->stock }}</td>
                                <td>
                                    <form action="{{ route('medicine.edit', $medicine->id) }}" method="GET"
                                        class="d-inline">
                                        <button type="submit" class="btn btn-outline-warning btn-sm ms-2 rounded-pill">
                                            EDITAR
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('medicine.destroy', $medicine->id) }}" method="POST"
                                        class="d-inline">
                                          @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm ms-2 rounded-pill">
                                            APAGAR
                                        </button>
                                    </form>
                                    

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
