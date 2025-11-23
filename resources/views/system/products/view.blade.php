@extends('templates.index')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12 my-4">
                <x-alert />
                <h3 class="fw-bold" id="product-header">Visualizar Produto</h3>
            </div>

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
                    <div class="card-body text-center">
                        <span class="fw-bold text-body-secondary">{{ $product->name }}</span>
                    </div>
                </div>
            </div>

            <!-- Coluna direita - Informações -->
            <div class="col-6">
                <div class="row g-3 shadow rounded-4" style="padding:20px;">
                    <h2 class="fw-medium">Informações do Produto</h2>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nome Fantasia:</label>
                        <p class="text-body-tertiary">{{ $product->name }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Preço de Compra:</label>
                        <p class="text-body-tertiary">R$: {{ number_format($product->price, 2, ',', '.') }}</p>
                    </div>

                    <div class="col-6">
                        <label class="form-label fw-bold">Espécie:</label>
                        <p class="text-body-tertiary">{{ $product->specie->name ?? 'Não informado' }}</p>
                    </div>

                    <div class="col-6">
                        <label class="form-label fw-bold">Forma:</label>
                        <p class="text-body-tertiary">{{ $product->shape }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tipo:</label>
                        <p class="text-body-tertiary">{{ $product->type }}</p>
                    </div>

                    <div class="col-6">
                        <label class="form-label fw-bold">Fabricante:</label>
                        <p class="text-body-tertiary">{{ $product->maker }}</p>
                    </div>

                    <div class="col-4">
                        <label class="form-label fw-bold">Código do Produto:</label>
                        <p class="text-body-tertiary">{{ $product->id }}</p>
                    </div>

                    <div class="col-4">
                        <label class="form-label fw-bold">Quantidade:</label>
                        <p class="text-body-tertiary">{{ $product->stock->sum('quantity') }}</p>
                    </div>

                    <div class="col-4">
                        <label class="form-label fw-bold">Dosagem:</label>
                        <p class="text-body-tertiary">{{ $product->weight }}</p>
                    </div>

                    <div class="col-12 pb-3">
                        <label class="form-label fw-bold">Descrição:</label>
                        <p class="text-body-tertiary">{{ $product->description }}</p>
                    </div>

                    <!-- Botão de voltar -->
                    <div class="col-12 d-flex justify-content-end">
                        <a href="{{ route('product.index') }}" class="btn btn-warning fw-medium"
                            id="cancel-button">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line mt-5"></div>
@endsection
