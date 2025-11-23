@extends('templates.index')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12 my-4">
                <x-alert />
                <h3 class="fw-bold" id="product-header">Editar Produto</h3>
            </div>
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                class="row">
                @csrf
                @method('PUT')

                <!-- Coluna esquerda - Imagem -->
                <div class="col-6 d-flex justify-content-center">
                    <div class="card shadow" style="width: 32rem;" id="card-product">
                        <img id="preview-image"
                            src="{{ $product->image
                                ? (Str::startsWith($product->image, 'assets')
                                    ? asset($product->image)
                                    : asset('storage/' . $product->image))
                                : asset('assets/img/model-product.png') }}"
                            style="height: 300px; object-fit: contain; margin-top: 2rem;" alt="Imagem do produto">
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
                                value="{{ old('name', $product->name) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">Preço*</label>
                            <input type="number" class="form-control input-bg" id="price" name="price"
                                value="{{ old('price', $product->price) }}" step="0.01" min="0">
                        </div>

                        <div class="col-6">
                            <label for="specie_id" class="form-label">Espécie*</label>
                            <select id="specie_id" name="specie_id" class="form-select input-bg">
                                <option value="" selected disabled>Selecione...</option>
                                @foreach ($species as $specie)
                                    <option value="{{ $specie->id }}"
                                        {{ old('specie_id', $product->specie_id) == $specie->id ? 'selected' : '' }}>
                                        {{ $specie->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                            <label for="shape" class="form-label">Forma*</label>
                            <select id="shape" name="shape" class="form-select input-bg">
                                <option disabled {{ old('shape', $product->shape) == null ? 'selected' : '' }}>Selecione...
                                </option>
                                <option value="Comprimido"
                                    {{ old('shape', $product->shape) == 'Comprimido' ? 'selected' : '' }}>Comprimido</option>
                                <option value="Cápsula" {{ old('shape', $product->shape) == 'Cápsula' ? 'selected' : '' }}>
                                    Cápsula</option>
                                <option value="Xarope" {{ old('shape', $product->shape) == 'Xarope' ? 'selected' : '' }}>
                                    Xarope</option>
                                <option value="Solução injetável"
                                    {{ old('shape', $product->shape) == 'Solução injetável' ? 'selected' : '' }}>Solução
                                    injetável</option>
                                <option value="Pomada" {{ old('shape', $product->shape) == 'Pomada' ? 'selected' : '' }}>
                                    Pomada</option>
                            </select>
                        </div>
                        
                        <div class="col-6">
                            <label for="maker" class="form-label">Fabricante</label>
                            <input type="text" class="form-control input-bg" id="maker" name="maker"
                                placeholder="Ex: OMS" value="{{ old('maker', $product->maker) }}">
                        </div>

                        <div class="col-md-6">
                            <label for="type" class="form-label">Tipo*</label>
                            <select id="type" name="type" class="form-select input-bg">
                                <option disabled {{ old('type', $product->type) == null ? 'selected' : '' }}>Selecione...
                                </option>
                                <option value="Genérico"
                                    {{ old('type', $product->type) == 'Genérico' ? 'selected' : '' }}>Genérico</option>
                                <option value="Referência"
                                    {{ old('type', $product->type) == 'Referência' ? 'selected' : '' }}>Referência
                                </option>
                                <option value="Similar" {{ old('type', $product->type) == 'Similar' ? 'selected' : '' }}>
                                    Similar</option>
                            </select>
                        </div>

                        <div class="col-6">
                            <label for="id" class="form-label">Código do Produto</label>
                            <input type="text" class="form-control" id="id"
                                placeholder="{{ old('id', $product->id) }}" disabled>
                        </div>

                        <div class="col-12 pb-3">
                            <label for="description" class="form-label">Descrição</label>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Para que serve?" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                                <label for="description">Para que serve?</label>
                            </div>
                        </div>

                        <!-- Botões -->
                        <div class="col-12 d-flex justify-content-end gap-3">
                            <a href="{{ route('products.index') }}" class="btn btn-warning fw-medium"
                                id="cancel-button">Cancelar</a>

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
