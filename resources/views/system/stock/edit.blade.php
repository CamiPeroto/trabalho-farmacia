@extends('templates.index')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12 my-4">
                <x-alert />
                <h3 class="fw-bold" id="medicine-header">Editar Estoque do Produto</h3>
            </div>
            <form action="{{ route('stock.update', $stock->id) }}" method="POST" enctype="multipart/form-data" class="row">
                @csrf
                @method('PUT')

                <!-- Coluna esquerda - Imagem -->
                <div class="col-6 d-flex justify-content-center">
                    <div class="card shadow" style="width: 32rem;" id="card-stock">
                        <img id="preview-image"
                            src="{{ $medicine->image
                                ? (Str::startsWith($medicine->image, 'assets')
                                    ? asset($medicine->image)
                                    : asset('storage/' . $medicine->image))
                                : asset('assets/img/model-medicine.webp') }}"
                            style="height: 300px; object-fit: contain; margin-top: 2rem;" alt="Imagem do produto">
                    </div>
                </div>

                <!-- Coluna direita - Informações -->
                <div class="col-6">
                    <div class="row g-3 shadow rounded-4 mt-1" style="padding:20px">
                        <h2 class="fw-medium">Informações do Produto</h2>

                        <div class="col-6">
                            <label for="id" class="form-label">Código do Produto</label>
                            <input type="text" class="form-control" id="id"
                                placeholder="{{ old('id', $medicine->id) }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="fantasy-name" class="form-label">Nome Fantasia*</label>
                            <input type="text" class="form-control input-bg" id="fantasy_name" name="fantasy_name"
                                value="{{ old('fantasy_name', $medicine->fantasy_name) }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="unitary_price" class="form-label">Preço Unitário*</label>
                            <input type="number" class="form-control input-bg" id="unitary_price" name="unitary_price"
                                value="{{ old('unitary_price', $stock->unitary_price) }}" step="0.01" min="0">
                        </div>

                        <div class="col-6">
                            <label for="quantity" class="form-label">Quantidade</label>
                            <input type="text" class="form-control input-bg" id="quantity" name="quantity"
                                placeholder="Ex: OMS" value="{{ old('quantity', $stock->quantity) }}">
                        </div>
                        <div class="col-6">
                            <label for="expiration_date" class="form-label">Data de Validade*</label>
                            <input type="date" class="form-control input-bg" id="expiration_date" name="expiration_date"
                                value="{{ old('expiration_date', isset($stock->expiration_date) ? \Carbon\Carbon::parse($stock->expiration_date)->format('Y-m-d') : '') }}"
                                required>
                        </div>
                        <div class="col-12 d-flex align-items-center gap-4">
                            <label class="form-label mb-0 me-3">Status:</label>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="ativo"
                                    value="1" {{ old('is_active', $stock->status) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="ativo">
                                    Ativo
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="inativo"
                                    value="0" {{ old('is_active', $stock->status) == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="inativo">
                                    Inativo
                                </label>
                            </div>
                        </div>

                        <!-- Botões -->
                        <div class="col-12 d-flex justify-content-end gap-3">
                            <a href="{{ route('stock.index') }}" class="btn btn-warning fw-medium"
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
