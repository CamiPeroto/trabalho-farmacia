@extends('templates.index')

@section('content')
<div class="container mt-5">
    <div class="d-flex align-items-center mt-4">
        <div class="bg-warning rounded-circle d-flex justify-content-center align-items-center"
            style="width:55px; height:55px;">
            <i class="fi fi-rr-calendar text-white" style="font-size:20px;"></i>
        </div>
        <div class="ms-3">
            <h4 class="fw-bold mb-0">Agendamento Marcados</h4>
            <small class="text-muted">Agendamentos de banho e tosa</small>
        </div>
    </div>
    <div class="col-12 mb-4 d-flex justify-content-end">
        <a href="{{ route('appointments.create') }}"
           class="btn btn-light rounded-circle shadow d-flex align-items-center justify-content-center"
           id="white-circle" style="width: 48px; height: 48px;">
            <img src="{{ asset('assets/img/add-icon.png') }}" alt="+" style="width: 12px; height: 12px;">
        </a>
    </div>

    <x-alert />

    <div class="row g-4">
        @forelse ($appointments as $appointment)
            <div class="col-md-6 col-lg-4   ">
                <div class="card shadow rounded-4 h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $appointment->pet_name }}</h5>
                        <p class="card-text mb-1"><strong>Telefone do dono:</strong> {{ $appointment->owner_phone }}</p>
                        <p class="card-text mb-1">
                            <strong>Data:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}
                        </p>
                        <p class="card-text mb-1">
                            <strong>Hora:</strong> {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}
                        </p>
                        <p class="card-text mb-1">
                            <strong>Serviços:</strong> 
                            @if($appointment->services)
                                {{ implode(', ', json_decode($appointment->services)) }}
                            @endif
                        </p>
                        <p class="card-text mb-3"><strong>Valor Total:</strong> R$ {{ number_format($appointment->total_value, 2, ',', '.') }}</p>

                        <div class="mt-auto d-flex justify-content-between">
                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-outline-warning btn-sm rounded-pill">
                             EDITAR
                        </a>
                            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">APAGAR</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">Nenhum agendamento encontrado.</p>
            </div>
        @endforelse
    </div>

    <!-- Paginação -->
    <div class="d-flex justify-content-end mt-4">
        {{ $appointments->links() }}
    </div>
</div>
@endsection
