@extends('templates.index')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12 my-4">
                <x-alert />
                <h3 class="fw-bold" id="product-header">Cadastrar Produto</h3>
            </div>
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="row">
                @csrf

                <!-- Coluna esquerda - Imagem -->
                <div class="col-6 d-flex justify-content-center">
                    <div class="card shadow" style="width: 32rem;" id="card-product">
                        <img id="preview-image" src="{{ asset('assets/img/model-product.png') }}"
                            style="height: 300px; object-fit: contain;margin-top:2rem;" alt="Pré-visualização da imagem">
                        <div class="card-body d-flex justify-content-center">
                            <input type="file" class="form-control upload-img" name="image" id="image"
                                style="height: 3rem;" accept="image/* "onchange="previewImage(event)">
                            <ul class="list-group list-group-flush" style="height:3rem;">
                                <li class="list-group-item text-center">SVG, PNG ou JPG (máx: 3MB)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Coluna direita - Informações -->
                <div class="col-6">
                    <div class="row g-3 shadow rounded-4" style="padding:20px;">
                        <h2 class="fw-medium">Informações do Produto</h2>

                        <div class="col-md-6">
                            <label for="name" class="form-label">Nome*</label>
                            <input type="text" class="form-control input-bg" id="name" name="name"
                                value="{{ old('name') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">Preço de Compra*</label>
                            <input type="number" class="form-control input-bg" id="price" name="price"value="{{ old('price') }}" step="0.01" min="0" placeholder="R$:">
                        </div>

                        <div class="col-6">
                            <label for="specie_id" class="form-label">Espécie*</label>
                            <select id="specie_id" name="specie_id" class="form-select input-bg">
                                <option value="" selected disabled>Selecione...</option>
                                @foreach ($species as $specie)
                                    <option value="{{ $specie->id }}"
                                        {{ old('specie_id') == $specie->id ? 'selected' : '' }}>
                                        {{ $specie->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                            <label for="shape" class="form-label">Forma*</label>
                            <select id="shape" name="shape" class="form-select input-bg">
                                <option selected>Selecione...</option>
                                <option>Comprimido</option>
                                <option value="Saco">Saco</option>
                                <option value="Xarope">Xarope</option>
                                <option value="Solução injetável">Solução injetável</option>
                                <option value="Pomada">Pomada</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="type" class="form-label">Tipo*</label>
                            <select id="type" name="type" class="form-select input-bg">
                                <option selected>Selecione...</option>
                                <option>Genérico</option>
                                <option value="Referência">Referência</option>
                                <option value="Similar">Similar</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="maker" class="form-label">Fabricante</label>
                            <input type="text" class="form-control input-bg" id="maker" name="maker"
                                placeholder="Ex: OMS" value="{{ old('maker') }}">
                        </div>
                        <div class="col-4">
                            <label for="id" class="form-label">Código do Produto</label>
                            <input type="text" class="form-control" id="id" placeholder="1"  value="{{ $nextId ?? 1 }}" disabled>
                        </div>
                        <div class="col-4">
                            <label for="quantity" class="form-label">Quantidade</label>
                            <input type="number" class="form-control input-bg" id="quantity" name="quantity" placeholder="UNT"
                                value="{{ old('quantity') }}" min="1">
                        </div>

                        <div class="col-12 pb-3">
                            <label for="description" class="form-label">Descrição</label>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Para que serve?" id="description" name="description"
                                    value="{{ old('description') }}"></textarea>
                                <label for="description">Para que serve?</label>
                            </div>
                        </div>

                        <!-- Botões -->
                        <div class="col-12 d-flex justify-content-end gap-3">
                            <a href="{{ route('product.index') }}" class="btn btn-warning fw-medium" id="cancel-button">Cancelar</a>
                            <button type="submit" class="btn btn-warning" id="save-button">Salvar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <div class="line mt-5"></div>

    <!-- Script para pré-visualização da imagem -->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview-image');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
