@extends('templates.index')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12 my-3">
                <x-alert />
                <h3 class="fw-bold">Nova Promoção</h3>
            </div>
            <form action="{{ route('promotion.store') }}" method="POST" enctype="multipart/form-data" class="row">
                @csrf

                <div class="col-6 d-flex justify-content-center">
                    <div class="w-100 shadow rounded-4 p-3" style="max-height: 30rem; overflow-y: auto;">
                        <h5 class="fw-bold mb-3">Escolha o Remédio</h5>
                        @foreach ($medicines as $medicine)
                            <div class="form-check d-flex align-items-center mb-3" style="height: 80px;">
                                <input class="form-check-input me-3" type="radio" name="medicine_id"
                                    id="medicine{{ $medicine->id }}" value="{{ $medicine->id }}" required>
                                <label class="form-check-label d-flex align-items-center w-100"
                                    for="medicine{{ $medicine->id }}">
                                    <img src="{{ $medicine->image ? asset('storage/' . $medicine->image) : 'https://via.placeholder.com/80' }}"
                                        alt="{{ $medicine->fantasy_name }}" class="rounded me-3" width="60"
                                        height="60">
                                    <div>
                                        <strong>{{ $medicine->fantasy_name }}</strong><br>
                                        <small>{{ $medicine->description ?? 'Sem descrição' }}</small>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Coluna direita - Informações -->
                <div class="col-6">
                    <div class="row g-3 shadow rounded-4 mt-1" style="padding:20px;min-height: 30rem;">
                        <h2 class="fw-medium">Informações da Promoção</h2>
                        <div class="col-3">
                            <label for="medicine_id" class="form-label">Código do remédio</label>
                            <input type="text" class="form-control" id="medicine_code_display" placeholder="N°" disabled>
                        </div>
                        <div class="col-3">
                            <label for="price" class="form-label">Preço Normal*</label>
                            <input type="text" class="form-control input-bg" id="price" name="price"
                                placeholder="R$" value="">
                        </div>
                        <div class="col-6">
                            <label for="promotional_price" class="form-label">Preço Promotional*</label>
                            <input type="text" class="form-control input-bg" id="promotional_price"
                                name="promotional_price" placeholder="R$" value="">
                        </div>
                        <div class="col-6">
                            <label for="start_date" class="form-label">Data de Início*</label>
                            <input type="date" class="form-control input-bg" id="start_date" name="start_date" required>
                        </div>

                        <div class="col-6">
                            <label for="end_date" class="form-label">Data de Fim*</label>
                            <input type="date" class="form-control input-bg" id="end_date" name="end_date" required>
                        </div>
                    </div>
                    <!-- Botões -->
                    <div class="col-12 d-flex justify-content-end gap-3 mt-2">
                        <button type="reset" class="btn btn-warning fw-medium" id="cancel-button">Cancelar</button>
                        <button type="submit" class="btn btn-warning" id="save-button">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <div class="line mt-5"></div>
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radioButtons = document.querySelectorAll('input[name="medicine_id"]');
            const codeInput = document.getElementById('medicine_code_display');

            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        codeInput.value = this.value;
                    }
                });
            });
        });
    </script>
@endsection
@endsection
