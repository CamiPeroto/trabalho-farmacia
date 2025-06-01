@extends('templates.index')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12 my-3">
                <x-alert />
                <h3 class="fw-bold">Editar Promoção</h3>
            </div>

            <form action="{{ route('promotion.update', $promotion->id) }}" method="POST" enctype="multipart/form-data" class="row">
                @csrf
                @method('PUT')

                {{-- Coluna esquerda: medicamento fixo --}}
                <div class="col-6 d-flex justify-content-center">
                    <div class="w-100 shadow rounded-4 p-3" style="max-height: 30rem; overflow-y: auto;">
                        <h5 class="fw-bold mb-3">Remédio Selecionado</h5>
                        @foreach ($medicines as $medicine)
                            <div class="form-check d-flex align-items-center mb-3" style="height: 80px;">
                                <input 
                                    class="form-check-input me-3" 
                                    type="radio" name="medicine_id"
                                    id="medicine{{ $medicine->id }}" 
                                    value="{{ $medicine->id }}"
                                    data-price="{{ $medicine->price }}"
                                    data-min-price="{{ $medicine->min_promotional_price ?? 0 }}"
                                    {{ $medicine->id == $promotion->medicine_id ? 'checked' : '' }}
                                    disabled
                                >
                                <label class="form-check-label d-flex align-items-center w-100"
                                    for="medicine{{ $medicine->id }}">
                                    <img src="{{ $medicine->image ? asset('storage/' . $medicine->image) : 'https://via.placeholder.com/80' }}"
                                        alt="{{ $medicine->fantasy_name }}" class="rounded me-3" width="60" height="60">
                                    <div>
                                        <strong>{{ $medicine->fantasy_name }}</strong><br>
                                        <small>{{ $medicine->description ?? 'Sem descrição' }}</small>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                        <input type="hidden" name="medicine_id" value="{{ $promotion->medicine_id }}">
                    </div>
                </div>

                {{-- Coluna direita: edição dos dados da promoção --}}
                <div class="col-6">
                    <div class="row g-3 shadow rounded-4 mt-1" style="padding:20px;min-height: 30rem;">
                        <h2 class="fw-medium">Informações da Promoção</h2>

                        <div class="col-3">
                            <label for="medicine_code_display" class="form-label">Código do remédio</label>
                            <input type="text" class="form-control" id="medicine_code_display"
                                value="{{ $promotion->medicine_id }}" disabled>
                        </div>

                        <div class="col-3">
                            <label for="price" class="form-label">Preço Normal*</label>
                            <input type="text" class="form-control input-bg" id="price"
                                value="{{ number_format($promotion->medicine->price, 2, ',', '.') }}" disabled>
                        </div>

                        <div class="col-6">
                            <label for="promotional_price" class="form-label">Preço Promocional*</label>
                            <input type="text" class="form-control input-bg" id="promotional_price"
                                name="promotional_price" placeholder="R$"
                                value="{{ number_format($promotion->promotional_price, 2, ',', '.') }}">
                            <span id="minPriceBadge" class="badge bg-info text-dark mt-2 d-none">
                                Valor mínimo: R$ 0,00
                            </span>
                        </div>

                        <div class="col-6">
                            <label for="start_date" class="form-label">Data de Início*</label>
                            <input type="date" class="form-control input-bg" id="start_date" name="start_date"
                                value="{{ $promotion->start_date->format('Y-m-d') }}" required>
                        </div>

                        <div class="col-6">
                            <label for="end_date" class="form-label">Data de Fim*</label>
                            <input type="date" class="form-control input-bg" id="end_date" name="end_date"
                                value="{{ $promotion->end_date->format('Y-m-d') }}" required>
                        </div>
                    </div>

                    {{-- Botões --}}
                    <div class="col-12 d-flex justify-content-end gap-3 mt-2">
                        <a href="{{ route('promotion.index') }}" class="btn btn-warning fw-medium" id="cancel-button">Cancelar</a>
                        <button type="submit" class="btn btn-warning" id="save-button">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="line mt-5"></div>
@endsection

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radio = document.querySelector('input[name="medicine_id"]:checked');
            const codeInput = document.getElementById('medicine_code_display');
            const priceInput = document.getElementById('price');
            const minPriceBadge = document.getElementById('minPriceBadge');

            if (radio) {
                codeInput.value = radio.value;

                const price = radio.getAttribute('data-price');
                const minPrice = parseFloat(radio.getAttribute('data-min-price'));

                if (price) {
                    priceInput.value = parseFloat(price).toLocaleString('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    });
                }

                if (!isNaN(minPrice) && minPrice > 0) {
                    minPriceBadge.classList.remove('d-none');
                    minPriceBadge.innerText = 'Valor mínimo: ' + minPrice.toLocaleString('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    });
                } else {
                    minPriceBadge.classList.add('d-none');
                }
            }
        });
    </script>
@endsection
