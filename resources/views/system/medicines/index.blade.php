@extends('templates.index')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12 my-4">
                <h3 class="fw-bold">Cadastrar Produto</h3>
            </div>
            <div class="col-6 d-flex justify-content-center align">
                <div class="card shadow" style="width: 30rem;" id="card-medicine">
                    <img src="https://www.vitamedic.ind.br/wp-content/uploads/elementor/thumbs/dipirona-500mg-qwo4lz3t3yza31awhrif0tzfebnqhtnkpq6eeow21k.png"
                        class="card-img-top" alt="...">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item justify-content-center">SVG, PNG or JPG (max: 3MB)</li>
                    </ul>
                    <div class="card-body d-flex justify-content-center">
                        <a href="#" class="card-link">Carregar uma imagem</a>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <form class="row g-3 shadow">
                    <h2 class="fw-medium">Informações do Produto</h2>
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome*</label>
                        <input type="text" class="form-control input-bg" id="name">
                    </div>
                    <div class="col-md-6">
                        <label for="fantasy-name" class="form-label">Nome Fantasia*</label>
                        <input type="text" class="form-control input-bg" id="fantasy-name">
                    </div>
                    <div class="col-6">
                        <label for="active-ingredient" class="form-label">Princípio Ativo*</label>
                        <select id="inputState" class="form-select input-bg">
                            <option selected>Selecione...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="form" class="form-label">Forma*</label>
                        <select id="inputState" class="form-select input-bg">
                            <option selected>Selecione...</option>
                            <option>Comprimido</option>
                        </select>
                    </div>
                    
                    <div class="col-6">
                        <label for="dose" class="form-label">Dosagem*</label>
                        <input type="text" class="form-control input-bg" id="dose" placeholder="5mg">
                    </div>
                    <div class="col-6">
                        <label for="maker" class="form-label">Fabricante</label>
                        <input type="text" class="form-control input-bg" id="maker" placeholder="Ex: OMS">
                    </div>

                    <div class="col-md-6">
                        <label for="type" class="form-label">Tipo*</label>
                        <select id="inputState" class="form-select input-bg">
                            <option selected>Selecione...</option>
                            <option>Genérico</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="id" class="form-label">Código do Produto</label>
                        <input type="text" class="form-control" id="id" placeholder="1" disabled>
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Descrição</label>
                        <div class="form-floating">

                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Para que serve ?</label>
                        </div>
                    </div>
                    <div class="row my-5 ms-auto ">
                        <div class="col-12 d-flex justify-content-end gap-3">
                            <button type="submit" class="btn btn-warning fw-medium" id="cancel-button">Cancelar</button>
                            <button type="submit" class="btn btn-warning" id="save-button">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="line mt-5"></div>
@endsection
