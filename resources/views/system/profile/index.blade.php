@extends('templates.profile')

@section('content')
    <div class="container my-5">
        <div class="card p-4 shadow-sm rounded-4 card-bg-profile">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-3">
                    <img src="https://www.svgrepo.com/show/384674/account-avatar-profile-user-11.svg" width="50"
                        alt="Avatar">
                    <div>
                        <h5 class="mb-0 text-uppercase text-primary fw-bold">Rafael Gasperin</h5>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-6">
                    <label class="form-label small">Função</label>
                    <input type="text" class="form-control" value="Vendedor" readonly>
                </div>
                <div class="col-6">
                    <label class="form-label small">Codigo de Vendedor</label>
                    <input type="text" class="form-control" value="0001" readonly>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <label class="form-label small">Salário Base</label>
                    <input type="text" class="form-control" value="R$5500,00" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label small">Contratado em</label>
                    <input type="text" class="form-control" value="10/02/2024" readonly>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-12">
                    <label class="form-label small">Usuário do Sistema</label>
                    <input type="text" class="form-control" value="rafael.barateira" readonly>
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
                <div class="mb-3">
                    <span class="fw-bold text-primary">Janeiro</span>
                    <div class="d-flex justify-content-between small mt-1">
                        <span>51 Vendas</span>
                        <span>R$102,85</span>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-warning" style="width: 20%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <span class="fw-bold text-primary">Fevereiro</span>
                    <div class="d-flex justify-content-between small mt-1">
                        <span>151 Vendas</span>
                        <span>R$302,25</span>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-info" style="width: 60%"></div>
                    </div>
                </div>
                <div class="mb-1">
                    <span class="fw-bold text-primary">Março</span>
                    <div class="d-flex justify-content-between small mt-1">
                        <span>307 Vendas</span>
                        <span>R$610,25</span>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-success" style="width: 90%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
