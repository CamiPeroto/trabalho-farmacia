@extends('templates.index')

@section('content')
    <div class="container my-5">
        <div class="row d-flex">
            <div class="col-6 my-4">
                <h3 class="fw-bold">Princípio Ativo</h3>
            </div>
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
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Paracetamol</td>
                            <td>Analgésico e antipirético usado no tratamento de febres e dores leves a moderadas.</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Ibuprofeno</td>
                            <td>Anti-inflamatório não esteroide utilizado para alívio de dores, febre e inflamações.</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Amoxicilina</td>
                            <td>Antibiótico da classe das penicilinas usado para tratar infecções bacterianas.</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Loratadina</td>
                            <td>Anti-histamínico utilizado no tratamento de alergias sazonais e urticária.</td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Dipirona</td>
                            <td>Analgésico e antipirético potente, usado em casos de dor intensa ou febre alta.</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr style="height: 7vh;">
                            <td colspan="3"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="line mt-5"></div>
@endsection

{{-- Card Principio Ativo --}}
<div class="modal fade" id="createActiveModal" tabindex="-1" aria-labelledby="createActiveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-4 rounded shadow" style="max-width: 500px; margin: auto;">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold" id="createActiveModalLabel">Novo Princípio Ativo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <form method="GET" action="#">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div>
          <div class="d-flex justify-content-end gap-2">
             <button type="submit" class="btn btn-warning fw-medium" id="cancel-ai">Cancelar</button>
            <button type="submit" class="btn btn-warning" id="ai-button">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- Card Principio Ativo --}}
