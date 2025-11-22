@extends('templates.index')

@section('content')
<div class="container my-4">
    <div class="row d-flex">
        <div class="col-12 mb-4 ps-2">
            <h3 class="fw-bold">Pagamentos</h3>
        </div>   
    </div>
    <form action="#" method="POST">
        @csrf
        <div class="p-4 shadow rounded bg-light">
            <div class="d-flex align-items-center mb-4">
                <div class="bg-success rounded-circle d-flex justify-content-center align-items-center"
                     style="width:55px; height:55px;">
                     <i class="fi fi-rr-expense text-white" style="font-size:20px;"></i>
                </div>

                <div class="ms-3">
                    <h4 class="fw-bold mb-0">Pagamento</h4>
                    <small class="text-muted">Finalize o pagamento do serviço</small>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Valor Total</label>
                    <div class="form-control bg-white fw-bold text-success fs-4">
                        R$ 120,00
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Método de Pagamento *</label>
                    <select class="form-select">
                        <option disabled selected>Escolha uma opção</option>
                        <option>PIX</option>
                        <option>Cartão de crédito</option>
                        <option>Cartão de débito</option>
                        <option>Dinheiro</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 mb-3">
                    <label class="form-label">CPF na nota?</label>

                    <div class="d-flex gap-4 mt-2">

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cpf_nota" id="cpfSim">
                            <label class="form-check-label" for="cpfSim">
                                Sim
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="cpf_nota" id="cpfNao" checked>
                            <label class="form-check-label" for="cpfNao">
                                Não
                            </label>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">CPF</label>
                    <input type="text" class="form-control" placeholder="000.000.000-00">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-3 mt-4">
            <button type="reset" class="btn btn-outline-danger">Cancelar</button>
            <button type="submit" class="btn btn-success text-white fw-bold">Confirmar Pagamento</button>
        </div>
    </form>
</div>
@endsection
