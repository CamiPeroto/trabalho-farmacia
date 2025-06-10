@extends('templates.index')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12 my-3">
                <x-alert />
                <h3 class="fw-bold">Venda de Produtos</h3>
            </div>
            <form action="{{ route('sale.store') }}" method="POST" class="row">
                @csrf
                <div class="col-6 d-flex justify-content-center">
                    <div class="w-100 shadow rounded-4 p-3" style="max-height: 30rem; overflow-y: auto;">
                        <h5 class="fw-bold mb-3">Selecione o Produto</h5>
                        @foreach ($medicines as $medicine)
                            <div class="form-check d-flex align-items-center justify-content-between mb-3"
                                style="height: 80px;">
                                <input class="form-check-input me-3" type="checkbox" name="medicines[]"
                                    id="medicine{{ $medicine->id }}" value="{{ $medicine->id }}"
                                    data-unit-price="{{ $medicine->unit_price }}">
                                <label class="form-check-label flex-grow-1" for="medicine{{ $medicine->id }}">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $medicine->image ? (Str::startsWith($medicine->image, 'assets') ? asset($medicine->image) : asset('storage/' . $medicine->image)) : 'https://via.placeholder.com/80' }}"
                                        alt="{{ $medicine->fantasy_name }}" class="rounded me-3" width="60"
                                        height="60">
                                        <div>
                                            <strong>{{ $medicine->fantasy_name }}</strong><br>
                                            <small>{{ $medicine->description ?? 'Sem descrição' }}</small>
                                        </div>
                                    </div>
                                </label>
                                <input type="number" class="form-control" name="quantities[{{ $medicine->id }}]"
                                    min="1" value="1" style="width: 60px; max-height:40px;">
                                <div class="fw-bold ms-3" style="min-width: 100px; text-align: right;">
                                    R$ {{ number_format($medicine->unit_price, 2, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-6">
                    <div class="row g-3 shadow rounded-4 mt-1 p-4" style="min-height: 30rem;">
                        <h4 class="fw-medium mb-4">Detalhes da Venda</h4>

                        <div class="col-6">
                            <label for="price_display" class="form-label">Id da Venda</label>
                            <input type="text" class="form-control" id="price_display" disabled placeholder="1">
                        </div>
                        <div class="col-6">
                            <label for="price_display" class="form-label">Cód Vendedor</label>
                            <input type="text" class="form-control" disabled value="{{ $sellerId }}">
                        </div>

                        <div class="col-12">
                            <label for="cpf" class="form-label">CPF do Cliente</label>
                            <input type="text" class="form-control" id="cpf" name="cpf"
                                placeholder="000.000.000-00" maxlength="14" required>
                        </div>

                        <div class="col-12">
                            <label for="total_display" class="form-label">Total</label>
                            <input type="text" class="form-control fw-bold" id="total_display" disabled
                                placeholder="R$ 0,00">
                        </div>

                        <!-- Botões -->
                        <div class="col-12 d-flex justify-content-end gap-3 mt-4">
                            <button type="reset" class="btn btn-warning fw-medium" id="cancel-button">Cancelar</button>
                            <button type="submit" class="btn btn-success" id="submit-button">Finalizar Venda</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const medicineCheckboxes = document.querySelectorAll('input[type="checkbox"][name="medicines[]"]');
            const totalDisplay = document.getElementById('total_display');

            function updateTotal() {
                let total = 0;
                medicineCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const id = checkbox.value;
                        const quantityInput = document.querySelector(`input[name="quantities[${id}]"]`);
                        const quantity = quantityInput ? parseInt(quantityInput.value) || 0 : 0;
                        const unitPrice = parseFloat(checkbox.getAttribute('data-unit-price')) || 0;
                        total += quantity * unitPrice;
                    }
                });
                totalDisplay.value = total.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                });
            }

            medicineCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateTotal);
                const id = checkbox.value;
                const quantityInput = document.querySelector(`input[name="quantities[${id}]"]`);
                if (quantityInput) {
                    quantityInput.addEventListener('input', () => {
                        if (checkbox.checked) {
                            updateTotal();
                        }
                    });
                }
            });

            // Inicializa total
            updateTotal();

            // Botão cancelar reseta tudo
            document.getElementById('cancel-button').addEventListener('click', () => {
                medicineCheckboxes.forEach(checkbox => checkbox.checked = false);
                medicineCheckboxes.forEach(checkbox => {
                    const id = checkbox.value;
                    const quantityInput = document.querySelector(`input[name="quantities[${id}]"]`);
                    if (quantityInput) quantityInput.value = 1;
                });
                totalDisplay.value = '';
            });
        });
    </script>
@endsection
