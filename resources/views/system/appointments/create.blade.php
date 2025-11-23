@extends('templates.index')

@section('content')
<div class="container my-4">
    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <div class="p-4 shadow rounded bg-light">
            <div class="d-flex align-items-center mb-4">
                <div class="bg-warning rounded-circle d-flex justify-content-center align-items-center"
                    style="width:55px; height:55px;">
                    <i class="fi fi-rr-calendar text-white" style="font-size:20px;"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0">Agendamento</h4>
                    <small class="text-muted">Agendamentos de banho e tosa</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nome do pet *</label>
                    <input type="text" name="pet_name" class="form-control" placeholder="Digite o nome completo" value="{{ old('pet_name') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Telefone proprietário *</label>
                    <input type="text" name="owner_phone" class="form-control" placeholder="(00) 9 0000-0000" value="{{ old('owner_phone') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Data *</label>
                    <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Horário *</label>
                    <input type="time" name="time" class="form-control" value="{{ old('time') }}">
                </div>
            </div>

            <div class="mt-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-success rounded-circle d-flex justify-content-center align-items-center"
                        style="width:55px; height:55px;">
                        <i class="fi fi-rr-scissors text-white" style="font-size:20px;"></i>
                    </div>
                    <h5 class="fw-bold ms-3">Serviços</h5>
                </div>

                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="border rounded p-3 bg-white d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-2" name="services[]" value="Banho" {{ (is_array(old('services')) && in_array('Banho', old('services'))) ? 'checked' : '' }}>
                                <div>
                                    <strong>Banho</strong><br>
                                    <small class="text-muted">R$ 30,00</small>
                                </div>
                            </div>
                            <i class="bi bi-droplet fs-4 text-secondary"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3 bg-white d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-2" name="services[]" value="Tosa" {{ (is_array(old('services')) && in_array('Tosa', old('services'))) ? 'checked' : '' }}>
                                <div>
                                    <strong>Tosa</strong><br>
                                    <small class="text-muted">R$ 40,00</small>
                                </div>
                            </div>
                            <i class="bi bi-scissors fs-4 text-secondary"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3 bg-white d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-2" name="services[]" value="Banho + Tosa" {{ (is_array(old('services')) && in_array('Banho + Tosa', old('services'))) ? 'checked' : '' }}>
                                <div>
                                    <strong>Banho + Tosa</strong><br>
                                    <small class="text-muted">R$ 60,00</small>
                                </div>
                            </div>
                            <i class="bi bi-stars fs-4 text-secondary"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border rounded p-3 bg-white d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-2" name="services[]" value="Hidratação" {{ (is_array(old('services')) && in_array('Hidratação', old('services'))) ? 'checked' : '' }}>
                                <div>
                                    <strong>Hidratação</strong><br>
                                    <small class="text-muted">R$ 25,00</small>
                                </div>
                            </div>
                            <i class="bi bi-droplet-half fs-4 text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 d-flex justify-content-end">
                <div class="col-md-4">
                    <div class="bg-white p-3 rounded shadow-sm d-flex justify-content-between align-items-center">
                        <strong class="fs-5">Valor Total:</strong>
                        <input type="hidden" name="total_value" id="total_value" value="{{ old('total_value', 0) }}">
                        <span class="fw-bold text-success fs-4" id="display_total">R$ {{ old('total_value', '0,00') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-3 mt-4">
            <button type="reset" class="btn btn-outline-danger">Cancelar</button>
            <button type="submit" class="btn btn-warning text-white fw-bold">Salvar</button>
        </div>
    </form>
</div>

<script>
    // Calcula o valor total automaticamente
    const services = document.querySelectorAll('input[name="services[]"]');
    const totalInput = document.getElementById('total_value');
    const displayTotal = document.getElementById('display_total');

    const prices = {
        'Banho': 30,
        'Tosa': 40,
        'Banho + Tosa': 60,
        'Hidratação': 25
    };

    services.forEach(s => {
        s.addEventListener('change', () => {
            let total = 0;
            services.forEach(cb => {
                if(cb.checked) total += prices[cb.value] || 0;
            });
            totalInput.value = total;
            displayTotal.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
        });
    });
</script>
@endsection
