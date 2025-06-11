@extends('templates.index')


@section('content')
    <div class="container my-5">
        <div class="row d-flex">
            <x-alert />
            <div class="col-4 my-4">
                <h3 class="fw-bold">Produtos em Promoção</h3>
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
                <a class="ms-2 text-decoration-none" href="{{ route('promotion.create') }}">
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
                            <th>Período</th>
                            <th>Preço Promocional</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($promotions as $promotion)
                            <tr>
                                <td class="d-flex align-items-center text-start">
                                    <a href="{{ route('medicine.show', $promotion->medicine->id) }}"
                                        class="d-flex align-items-center text-decoration-none text-dark">
                                        <img src="{{ $promotion->medicine->image ? (Str::startsWith($promotion->medicine->image, 'assets') ? asset($promotion->medicine->image) : asset('storage/' . $promotion->medicine->image)) : 'https://via.placeholder.com/150' }}"
                                            alt="{{ $promotion->medicine->fantasy_name }}" width="130" height="130"
                                            class="me-3 rounded my-3" style="cursor: pointer;">
                                        <div>
                                            <strong>{{ $promotion->medicine->fantasy_name }}</strong><br>
                                            <small class="description-limit"
                                                title="{{ $promotion->medicine->description }}">
                                                {{ $promotion->medicine->description ?? 'Sem descrição' }}</small>
                                        </div>
                                    </a>
                                </td>
                                <td class="fw-bold">
                                    {{ \Carbon\Carbon::parse($promotion->start_date)->format('d/m/Y') }} -
                                    {{ \Carbon\Carbon::parse($promotion->end_date)->format('d/m/Y') }}

                                    @if (\Carbon\Carbon::parse($promotion->end_date)->isPast())
                                        <br>
                                        <span class="text-danger">(ENCERRADA)</span>
                                    @endif
                                </td>
                                <td class="fw-bold">R$ {{ number_format($promotion->promotional_price, 2, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('promotion.edit', $promotion->id) }}"
                                        class="btn btn-outline-warning btn-sm ms-2 rounded-pill">EDITAR</a>

                                    <form action="{{ route('promotion.destroy', $promotion->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-outline-danger btn-sm ms-2 rounded-pill">APAGAR</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center alert alert-danger">
                                    Nenhuma promoção encontrada!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <x-pagination :paginator="$promotions" />
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
