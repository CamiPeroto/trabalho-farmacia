@extends('templates.index')

@section('content')
<div class="container my-1">
    <div class="row d-flex">
        <div class="col-12 my-4 ps-3">
            <h3 class="fw-bold">Cadastro de Pets</h3>
        </div>   
    </div>
    <form action="#" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="p-4 shadow rounded bg-white">
                    <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" 
                        style="width:50px; height:50px;">
                        <i class="fi fi-rr-paw" style="font-size:20px;"></i>
                    </div>

                        <div class="ms-3">
                            <h5 class="fw-bold mb-0">Dados do Pet</h5>
                            <small class="text-muted">Informações sobre o animal</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nome do Pet *</label>
                            <input type="text" class="form-control" placeholder="Digite o nome completo">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Espécie *</label>
                            <select class="form-select">
                                <option selected disabled>Selecione a espécie</option>
                                <option>Cachorro</option>
                                <option>Gato</option>
                                <option>Ave</option>
                            </select>
                        </div>
                    </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Raça *</label>
                        <input type="text" class="form-control" placeholder="Informe a raça">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Idade *</label>
                        <input type="text" class="form-control" placeholder="Ex: 2 anos, 6 meses">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Peso *</label>
                        <input type="text" class="form-control" placeholder="Ex: 2 KG">
                    </div>
                </div>
                    <div class="mb-3">
                        <label class="form-label">Observações</label>
                        <textarea class="form-control" rows="4" 
                            placeholder="Informações adicionais, temperamento, cuidados especiais, etc."></textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="p-4 shadow rounded bg-white">
                    <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" 
                        style="width:50px; height:50px;">
                        <i class="fi fi-rr-user" style="font-size:20px;"></i>
                    </div>
                        <div class="ms-3">
                            <h5 class="fw-bold mb-0">Dados do Proprietário</h5>
                            <small class="text-muted">Informações do responsável pelo pet</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nome Completo *</label>
                        <input type="text" class="form-control" placeholder="Digite o nome completo">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telefone *</label>
                        <input type="text" class="form-control" placeholder="(00) 9 0000-0000">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">CPF *</label>
                        <input type="text" class="form-control" placeholder="000.000.000-00">
                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex justify-content-end mt-4 gap-3">
            <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
            <button type="submit" class="btn btn-success">Salvar</button>
        </div>
    </form>
</div>
<img src="{{ asset('assets/img/dog-illustration.png') }}" class="card-img-top" alt="Dog" style="width: 8%; position: fixed;  bottom: 68px; left: 50%;
transform: translateX(-50%);">
@endsection
