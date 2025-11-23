@extends('templates.index')

@section('content')
<div class="container my-4">
<form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="p-4 shadow rounded bg-light">
            <div class="d-flex align-items-center mb-4">
                <div class="bg-warning rounded-circle d-flex justify-content-center align-items-center"
                     style="width:55px; height:55px;">
                    <i class="fi fi-rr-calendar text-white" style="font-size:20px;"></i>
                </div>
                <div class="ms-3">
                    <h4 class="fw-bold mb-0">Editar Agendamento</h4>
                    <small class="text-muted">Agendamentos de banho e tosa</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nome do pet *</label>
                    <input type="text" name="pet_name" class="form-control" placeholder="Digite o nome completo" 
                           value="{{ old('pet_name', $appointment->pet_name) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Telefone proprietário *</label>
                    <input type="text" name="owner_phone" class="form-control" placeholder="(00) 9 0000-0000" 
                           value="{{ old('owner_phone', $appointment->owner_phone) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Data *</label>
                    <input type="date" name="date" class="form-control" 
                    value="{{ old('date', \Carbon\Carbon::parse($appointment->date)->format('Y-m-d')) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Horário *</label>
                    <input type="time" name="time" class="form-control" 
       value="{{ old('time', \Carbon\Carbon::parse($appointment->time)->format('H:i')) }}">
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

                @php
                    $selectedServices = old('services', json_decode($appointment->services) ?? []);
                @endphp

                <div class="row g-3">
                    @php
                        $servicesList = [
                            ['name' => 'Banho', 'price' => 30, 'icon' => 'bi-droplet'],
                            ['name' => 'Tosa', 'price' => 40, 'icon' => 'bi-scissors'],
                            ['name' => 'Banho + Tosa', 'price' => 60, 'icon' => 'bi-stars'],
                            ['name' => 'Hidratação', 'price' => 25, 'icon' => 'bi-droplet-half']
                        ];
                    @endphp

                    @foreach($servicesList as $s)
                        <div class="col-md-3">
                            <div class="border rounded p-3 bg-white d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input me-2" name="services[]" 
                                           value="{{ $s['name'] }}" 
                                           {{ in_array($s['name'], $selectedServices) ? 'checked' : '' }}>
                                    <div>
                                        <strong>{{ $s['name'] }}</strong><br>
                                        <small class="text-muted">R$ {{ number_format($s['price'],2,',','.') }}</small>
                                    </div>
                                </div>
                                <i class="bi {{ $s['icon'] }} fs-4 text-secondary"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="row mt-5 d-flex justify-content-end">
                <div class="col-md-4">
                    <div class="bg-white p-3 rounded shadow-sm d-flex justify-content-between align-items-center">
                        <strong class="fs-5">Valor Total:</strong>
                        <input type="hidden" name="total_value" id="total_value" value="{{ old('total_value', $appointment->total_value) }}">
                        <span class="fw-bold text-success fs-4" id="display_total">
                            R$ {{ old('total_value', number_format($appointment->total_value, 2, ',', '.')) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-3 mt-4">
            <a href="{{ route('appointments.index') }}" class="btn btn-outline-danger">Cancelar</a>
            <button type="submit" class="btn btn-warning text-white fw-bold">Salvar</button>
        </div>
    </form>
</div>

<script>
    const services = document.querySelectorAll('input[name="services[]"]');
    const totalInput = document.getElementById('total_value');
    const displayTotal = document.getElementById('display_total');

    const prices = {
        'Banho': 30,
        'Tosa': 40,
        'Banho + Tosa': 60,
        'Hidratação': 25
    };

    function updateTotal() {
        let total = 0;
        services.forEach(cb => {
            if(cb.checked) total += prices[cb.value] || 0;
        });
        totalInput.value = total;
        displayTotal.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
    }

    // Atualiza total inicial
    updateTotal();

    services.forEach(s => s.addEventListener('change', updateTotal));
</script>
@endsection
