@extends('templates.index')

@section('content')
    <!-- Header -->
    <div class="container-fluid py-5 mb-3"style="background-color: #f4f6f8;">
        <div class="container py-2">
            <h2 class="fw-bold mb-0">Filiais</h2>
        </div>
    </div>

    <!-- Conteúdo principal -->
    <div class="container p-4 rounded" style="background-color: #f4f6f8;">
        <!-- Filtros -->
        <div class="row align-items-end mb-5">
            <div class="col-md-3">
                <label class="form-label">Pesquisar</label>
                <input type="text" class="form-control" placeholder="Nome da Filial">
            </div>
            <div class="col-md-3">
                <label class="form-label">Cidade</label>
                <select class="form-select">
                    <option>Cidade</option>
                    <option>Ponta Grossa</option>
                    <option>Curitiba</option>
                    <option>Campo Grande</option>
                </select>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button class="btn btn-outline-secondary w-100">
                    <i class="bi bi-funnel-fill"></i>
                </button>
            </div>
            <div class="col-md-5 text-end">
                <button class="btn btn-outline-dark me-2">AÇÃO</button>
                <button class="btn text-white" style="background-color: #00796B;">NOVO</button>
            </div>
        </div>

        <!-- Tabela -->
        <table class="table custom-table-bg table-hover align-middle rounded overflow-hidden custom-table-spacing">
            <thead class="table-light">
                <tr>
                    <th scope="col">Número da Filial</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Localização</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody class="custom-tbody">
                <tr>
                    <td>1</td>
                    <td>Filial PG</td>
                    <td><i class="bi bi-geo-alt-fill text-secondary icon-gray me-1"></i>Ponta Grossa</td>
                    <td class="status-column"><span class="badge badge-status">Ativa</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Filial Cwb</td>
                    <td><i class="bi bi-geo-alt-fill text-secondary icon-gray me-1"></i>Curitiba</td>
                    <td class="status-column"><span class="badge badge-status">Ativa</span></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Filial CG</td>
                    <td><i class="bi bi-geo-alt-fill text-secondary icon-gray me-1"></i>Campo Grande</td>
                    <td class="status-column"><span class="badge badge-status">Ativa</span></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Filial SP</td>
                    <td><i class="bi bi-geo-alt-fill text-secondary icon-gray me-1"></i>São Paulo</td>
                    <td class="status-column"><span class="badge badge-status">Ativa</span></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Filial Centro</td>
                    <td><i class="bi bi-geo-alt-fill text-secondary icon-gray me-1"></i>Centro</td>
                    <td><span class="badge bg-warning text-dark">Inativa</span></td>
                </tr>
            </tbody>
        </table>

        <!-- Paginação -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>Linhas por página:
                <select class="form-select d-inline-block w-auto ms-2">
                    <option>10</option>
                </select>
            </div>
            <div class="text-muted">1–5 of 15</div>
            <div>
                <button class="btn btn-sm btn-light">&lt;</button>
                <button class="btn btn-sm btn-light">&gt;</button>
            </div>
        </div>
    </div>
  
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
