@extends('templates.index')

@section('content')
    <div class="container my-5">
        <div class="row d-flex">
            <div class="col-6 my-4">
                <h3 class="fw-bold">Princípio Ativo</h3>
            </div>
            <x-alert />
            <div class="row">
                <div class="col-6 d-flex align-items-center justify-content-start">
                    <form class="d-flex justify-content-center me-5" role="search" action="{{ url('/search') }}"
                        method="GET">
                        <div class="position-relative w-100">
                            <i class="fi fi-rr-search position-absolute"
                                style="left: 18px; top: 50%; transform: translateY(-50%); color: gray; z-index: 2;"></i>
                            <input class="form-control search-sm ps-5 me-2" type="search" placeholder="Pesquisar..."
                                aria-label="Buscar" name="q">
                        </div>
                    </form>
                </div>
                <div class="col-6 my-4 d-flex justify-content-end">
                    <button type="button"
                        class="btn btn-light rounded-circle shadow d-flex align-items-center justify-content-center"
                        id="white-circle" style="width: 48px; height: 48px;" data-bs-toggle="modal"
                        data-bs-target="#createActiveModal">
                        <img src="{{ asset('assets/img/add-icon.png') }}" alt="+" style="width: 12px; height: 12px;">
                    </button>
                </div>
            </div>
            <div class="col-3 d-flex align-items-center justify-content-start gap-3 my-3" id="action-item">
                <p class="mb-0 fs-6 fw-bold">Filtros</p>
                <i class="fi fi-rr-bars-filter"></i>
            </div>
            <div class="col-3 d-flex align-items-center mb-2 justify-content-start gap-3">
                <p class="mb-0 fs-6 fw-bold">Exportar</p>
                <i class="fi fi-rr-download"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table custom-table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ingredients as  $ingredient)
                            <tr>
                                <th scope="row">{{ $ingredient->id }}</th>
                                <td>{{ $ingredient->name }}</td>
                                <td>{{ $ingredient->description }}</td>
                                <td class="d-md-flex flex-row ">
                                    <a href="#" class="btn btn-warning btn-sm me-1 mb-1 mb-md-0"
                                        data-bs-toggle="modal" data-bs-target="#editActiveModal"
                                        data-id="{{ $ingredient->id }}" data-name="{{ $ingredient->name }}"
                                        data-description="{{ $ingredient->description }}">
                                        <i class="fi fi-rr-file-edit"></i>
                                    </a>

                                    <form action="{{ route('ingredient.destroy', ['ingredient' => $ingredient->id]) }}"
                                        method="POST">
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
                                <td colspan="4" class="text-center alert alert-danger">
                                    Nenhum principio ativo encontrado!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr style="height: 7vh;">
                            <td colspan="4"></td>
                        </tr>
                    </tfoot>
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
        </div>
    </div>
    </div>
    <div class="line mt-5"></div>
@endsection

{{-- Card Principio Ativo --}}
<div class="modal fade" id="createActiveModal" tabindex="-1" aria-labelledby="createActiveModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 rounded shadow" style="max-width: 500px; margin: auto;">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="createActiveModalLabel">Novo Princípio Ativo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('ingredient.store') }}">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('ingredient.index') }}" class="btn btn-warning fw-medium"
                            id="cancel-ai">Cancelar</a>
                        <button type="submit" class="btn btn-warning" id="ai-button">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Card Principio Ativo --}}
{{-- Card Principio Ativo --}}
<div class="modal fade" id="editActiveModal" tabindex="-1" aria-labelledby="editActiveModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 rounded shadow" style="max-width: 500px; margin: auto;">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="editActiveModalLabel">Editar Princípio Ativo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editName" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Descrição</label>
                        <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-warning fw-medium"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Card Principio Ativo --}}
<script>
    const editModal = document.getElementById('editActiveModal');
    editModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const description = button.getAttribute('data-description');

        const form = document.getElementById('editForm');
        form.action = `/ingredient/${id}`; // Define action para update

        document.getElementById('editName').value = name;
        document.getElementById('editDescription').value = description;
    });
</script>
