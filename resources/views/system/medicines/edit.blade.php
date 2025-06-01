@extends('templates.index')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12 my-4">
                <x-alert />
                <h3 class="fw-bold" id="medicine-header">Editar Produto</h3>
            </div>
            <form action="{{ route('medicine.update', $medicine->id) }}" method="POST" enctype="multipart/form-data"
                class="row">
                @csrf
                @method('PUT')

                <!-- Coluna esquerda - Imagem -->
                <div class="col-6 d-flex justify-content-center">
                    <div class="card shadow" style="width: 32rem;" id="card-medicine">
                        <img id="preview-image"
                            src="{{ $medicine->image ? asset('storage/' . $medicine->image) : 'https://pixcap.com/cdn/library/template/1729793843829/thumbnail/Medicine_Bottle_Jar_3D_Icon_transparent_emp_800.webp' }}"
                            class="card-img-top my-3" style="height: 300px; object-fit: contain;"
                            alt="Pré-visualização da imagem">
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
                            <label for="fantasy-name" class="form-label">Nome Fantasia*</label>
                            <input type="text" class="form-control input-bg" id="fantasy_name" name="fantasy_name"
                                value="{{ old('fantasy_name', $medicine->fantasy_name) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">Preço*</label>
                            <input type="number" class="form-control input-bg" id="price" name="price"
                                value="{{ old('price', $medicine->price) }}" step="0.01" min="0">
                        </div>

                        <div class="col-6">
                            <label for="active_ingredient_id" class="form-label">Princípio Ativo*</label>
                            <select id="active_ingredient_id" name="active_ingredient_id" class="form-select input-bg">
                                <option value="" selected disabled>Selecione...</option>
                                @foreach ($ingredients as $ingredient)
                                    <option value="{{ $ingredient->id }}"
                                        {{ old('active_ingredient_id', $medicine->active_ingredient_id) == $ingredient->id ? 'selected' : '' }}>
                                        {{ $ingredient->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                            <label for="form" class="form-label">Forma*</label>
                            <select id="form" name="form" class="form-select input-bg">
                                <option disabled {{ old('form', $medicine->form) == null ? 'selected' : '' }}>Selecione...
                                </option>
                                <option value="Comprimido"
                                    {{ old('form', $medicine->form) == 'Comprimido' ? 'selected' : '' }}>Comprimido</option>
                                <option value="Cápsula" {{ old('form', $medicine->form) == 'Cápsula' ? 'selected' : '' }}>
                                    Cápsula</option>
                                <option value="Xarope" {{ old('form', $medicine->form) == 'Xarope' ? 'selected' : '' }}>
                                    Xarope</option>
                                <option value="Solução injetável"
                                    {{ old('form', $medicine->form) == 'Solução injetável' ? 'selected' : '' }}>Solução
                                    injetável</option>
                                <option value="Pomada" {{ old('form', $medicine->form) == 'Pomada' ? 'selected' : '' }}>
                                    Pomada</option>
                            </select>
                        </div>

                        <div class="col-6">
                            <label for="dosage" class="form-label">Dosagem*</label>
                            <input type="text" class="form-control input-bg" id="dosage" name="dosage"
                                placeholder="5mg" value="{{ old('dosage', $medicine->dosage) }}">
                        </div>

                        <div class="col-6">
                            <label for="maker" class="form-label">Fabricante</label>
                            <input type="text" class="form-control input-bg" id="maker" name="maker"
                                placeholder="Ex: OMS" value="{{ old('maker', $medicine->maker) }}">
                        </div>

                        <div class="col-md-6">
                            <label for="type" class="form-label">Tipo*</label>
                            <select id="type" name="type" class="form-select input-bg">
                                <option disabled {{ old('type', $medicine->type) == null ? 'selected' : '' }}>Selecione...
                                </option>
                                <option value="Genérico"
                                    {{ old('type', $medicine->type) == 'Genérico' ? 'selected' : '' }}>Genérico</option>
                                <option value="Referência"
                                    {{ old('type', $medicine->type) == 'Referência' ? 'selected' : '' }}>Referência
                                </option>
                                <option value="Similar" {{ old('type', $medicine->type) == 'Similar' ? 'selected' : '' }}>
                                    Similar</option>
                            </select>
                        </div>

                        <div class="col-6">
                            <label for="id" class="form-label">Código do Produto</label>
                            <input type="text" class="form-control" id="id"
                                placeholder="{{ old('id', $medicine->id) }}" disabled>
                        </div>

                        <div class="col-12 pb-3">
                            <label for="description" class="form-label">Descrição</label>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Para que serve?" id="description" name="description">{{ old('description', $medicine->description) }}</textarea>
                                <label for="description">Para que serve?</label>
                            </div>
                        </div>

                        <!-- Botões -->
                        <div class="col-12 d-flex justify-content-end gap-3">
                            <a href="{{ route('medicine.index') }}" class="btn btn-warning fw-medium" id="cancel-button">Cancelar</a>

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
