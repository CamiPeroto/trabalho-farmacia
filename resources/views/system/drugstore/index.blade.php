@extends('templates.index')

@section('content')
    <div class="container-fluid py-5"style="background-color: #f4f6f8;">
        <div class="container pt-2">
            <h2 class="fw-bold mb-0">Filiais</h2>
            <x-alert />
        </div>
    </div>

    <div class="container rounded" style="background-color: #f4f6f8;">
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
                <button class="btn text-white" data-bs-toggle="modal" data-bs-target="#createBranchModal"
                    style="background-color: #00796B;">NOVO</button>
            </div>
        </div>

        <!-- Tabela -->
        <table class="table custom-table-bg table-hover align-middle rounded overflow-hidden custom-table-spacing">
            <thead class="table-light">
                <tr>
                    <th scope="col">Número</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Localização</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody class="custom-tbody">
                @forelse ($drugstores as  $drugstore)
                    <tr>
                        <td>{{ $drugstore->id }}</td>
                        <td>{{ $drugstore->name }}</td>
                        <td><i class="bi bi-geo-alt-fill text-secondary icon-gray me-1"></i>{{ $drugstore->location }}</td>
                        <td class="status-column">
                            @if ($drugstore->status)
                                <span class="badge bg-info">Ativo</span>
                            @else
                                <span class="badge text-bg-secondary">Inativo</span>
                            @endif
                        </td>
                        <td class="d-md-flex flex-row ">
                            <a href="#" class="btn btn-warning btn-sm me-1 mb-1 mb-md-0" data-bs-toggle="modal"
                                data-bs-target="#editBranchModal" data-id="{{ $drugstore->id }}"
                                data-name="{{ $drugstore->name }}" data-location="{{ $drugstore->location }}"
                                data-status="{{ $drugstore->status == 1 ? '1' : '0' }}">
                                <i class="fi fi-rr-file-edit"></i>
                            </a>

                            <form action="#" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm me-1"
                                    onclick="return confirm('Tem certeza que deseja apagar o registro ?')"><i
                                        class="fi fi-rr-trash"></i> </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center alert alert-danger">
                            Nenhuma filial encontrada!
                        </td>
                    </tr>
                @endforelse
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
{{-- Card Criar Filial --}}
<div class="modal fade" id="createBranchModal" tabindex="-1" aria-labelledby="createBranchModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 rounded shadow" style="max-width: 500px; margin: auto;">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="createBranchModalLabel">Nova Filial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="#">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="branchName" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="branchName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="branchLocation" class="form-label">Localização</label>
                        <input type="text" class="form-control" id="branchLocation" name="location" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('drugstore.index') }}" class="btn btn-warning fw-medium"
                            id="cancel-ai">Cancelar</a>
                        <button type="submit" class="btn btn-warning" id="ai-button">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Card Editar Filial --}}
<div class="modal fade" id="editBranchModal" tabindex="-1" aria-labelledby="editBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 rounded shadow" style="max-width: 500px; margin: auto;">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="editBranchModalLabel">Editar Filial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="#" id="editBranchForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="editBranchName" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="editBranchName" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="editBranchLocation" class="form-label">Localização</label>
                        <input type="text" class="form-control" id="editBranchLocation" name="location" required>
                    </div>
                    <div class="d-flex gap-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="statusAtiva"
                                value="1" required>
                            <label class="form-check-label" for="statusAtiva">Ativa</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="statusInativa"
                                value="0" required>
                            <label class="form-check-label" for="statusInativa">Inativa</label>
                        </div>
                    </div>

                   <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('drugstore.index') }}" class="btn btn-warning fw-medium"
                            id="cancel-ai">Cancelar</a>
                        <button type="submit" class="btn btn-warning" id="ai-button">Salvar</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const editBranchModal = document.getElementById('editBranchModal');
    editBranchModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const location = button.getAttribute('data-location');
        const status = button.getAttribute('data-status');

        // Define os valores nos inputs
        document.getElementById('editBranchName').value = name;
        document.getElementById('editBranchLocation').value = location;

        if (status === "1") {
            document.getElementById('statusAtiva').checked = true;
        } else {
            document.getElementById('statusInativa').checked = true;
        }

        // Define a action do formulário
        const form = document.getElementById('editBranchForm');
        form.action = `/drugstore/${id}`;
    });
</script>
