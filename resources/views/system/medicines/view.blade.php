@extends('templates.index')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12 my-4">
                <x-alert />
                <h3 class="fw-bold" id="medicine-header">Visualizar Produto</h3>
            </div>

            <!-- Coluna esquerda - Imagem -->
            <div class="col-6 d-flex justify-content-center">
                <div class="card shadow" style="width: 32rem;" id="card-medicine">
                    <img id="preview-image"
                        src="{{ $medicine->image ? asset('storage/' . $medicine->image) : asset('assets/img/model-medicine.webp') }}"
                        style="height: 300px; object-fit: contain; margin-top: 2rem;" alt="Imagem do produto">
                    <div class="card-body text-center">
                        <span class="fw-bold">{{ $medicine->fantasy_name }}</span>
                    </div>
                </div>
            </div>

            <!-- Coluna direita - Informações -->
            <div class="col-6">
                <div class="row g-3 shadow rounded-4" style="padding:20px;">
                    <h2 class="fw-medium">Informações do Produto</h2>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nome Fantasia:</label>
                        <p class="text-body-tertiary">{{ $medicine->fantasy_name }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Preço de Compra:</label>
                        <p class="text-body-tertiary">R$: {{ number_format($medicine->price, 2, ',', '.') }}</p>
                    </div>

                    <div class="col-6">
                        <label class="form-label fw-bold">Princípio Ativo:</label>
                        <p class="text-body-tertiary">{{ $medicine->activeIngredient->name ?? 'Não informado' }}</p>
                    </div>

                    <div class="col-6">
                        <label class="form-label fw-bold">Forma:</label>
                        <p class="text-body-tertiary">{{ $medicine->form }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tipo:</label>
                        <p class="text-body-tertiary">{{ $medicine->type }}</p>
                    </div>

                    <div class="col-6">
                        <label class="form-label fw-bold">Fabricante:</label>
                        <p class="text-body-tertiary">{{ $medicine->maker }}</p>
                    </div>

                    <div class="col-4">
                        <label class="form-label fw-bold">Código do Produto:</label>
                        <p class="text-body-tertiary">{{ $medicine->id }}</p>
                    </div>

                    <div class="col-4">
                        <label class="form-label fw-bold">Quantidade:</label>
                        <p class="text-body-tertiary">{{ $medicine->quantity }}</p>
                    </div>

                    <div class="col-4">
                        <label class="form-label fw-bold">Dosagem:</label>
                        <p class="text-body-tertiary">{{ $medicine->dosage }}</p>
                    </div>

                    <div class="col-12 pb-3">
                        <label class="form-label fw-bold">Descrição:</label>
                        <p class="text-body-tertiary">{{ $medicine->description }}</p>
                    </div>

                    <!-- Botão de voltar -->
                    <div class="col-12 d-flex justify-content-end">
                        <a href="{{ route('medicine.index') }}" class="btn btn-warning fw-medium" id="cancel-button">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line mt-5"></div>
@endsection
