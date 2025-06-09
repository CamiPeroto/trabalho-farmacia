@extends('templates.profile')
@section('content')
    <div class="container my-5">
        <div class="card p-4 shadow-sm rounded-4 card-bg-profile">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-3">
                    <img src="https://www.svgrepo.com/show/384674/account-avatar-profile-user-11.svg" width="50"
                        alt="Avatar">
                    <div>
                        <h5 class="mb-0 text-uppercase text-primary fw-bold">
                            @if (auth()->check())
                                {{ auth()->user()->name }}
                            @endif
                        </h5>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-6">
                    <label class="form-label small">Função</label>
                    <input type="text" class="form-control" value="Vendedor" readonly>
                </div>
                <div class="col-6">
                    <label class="form-label small">Codigo de Funcionário</label>
                    <input type="text" class="form-control" value="0{{ Auth::id() }}" readonly>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <label class="form-label small">Salário Base</label>
                    <input type="text" class="form-control" value="R$5500,00" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label small">Contratado em</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->created_at->format('d/m/Y') }}" readonly>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-12">
                    <label class="form-label small">Usuário do Sistema</label>
                    <input type="text" class="form-control" value="{{ strtolower(Auth::user()->name) }}.barateira" readonly>
                </div>
            </div>

           <div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold">Comissões</h6>

        <a href="#" class="text-decoration-none text-primary small fw-bold">
            <i class="fi fi-rr-file-export me-2"></i>
            <span>EXPORTAR</span>
        </a>
    </div>

    @php
        // Mapeia o número do mês para nome
        $months = [
            1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
            5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
            9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
        ];
    @endphp

    @foreach ($comissions as $comission)
        <div class="mb-3">
            <span class="fw-bold text-primary">
                {{ $months[$comission->month] ?? 'Mês desconhecido' }} {{ $comission->year }}
            </span>
            <div class="d-flex justify-content-between small mt-1">
                <span>{{ $comission->sales_count }} Vendas</span>
                <span>R${{ number_format($comission->total_comission, 2, ',', '.') }}</span>
            </div>
            <div class="progress" style="height: 4px;">
                {{-- Calcula a largura da barra de progresso proporcional às vendas --}}
                @php
                    // Defina uma largura proporcional simples (exemplo: 2% por venda, máximo 100%)
                    $width = min($comission->sales_count * 2, 100);
                    // Muda a cor da barra conforme % (exemplo simples)
                    if ($width > 80) {
                        $color = 'bg-success';
                    } elseif ($width > 50) {
                        $color = 'bg-info';
                    } else {
                        $color = 'bg-warning';
                    }
                @endphp
                <div class="progress-bar {{ $color }}" style="width: {{ $width }}%"></div>
            </div>
        </div>
    @endforeach

    {{-- Caso não tenha comissões --}}
    @if($comissions->isEmpty())
        <p class="text-muted">Nenhuma comissão registrada.</p>
    @endif
</div>
        </div>
    </div>
@endsection
