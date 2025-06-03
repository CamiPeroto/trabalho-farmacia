@extends('templates.login')

@section('content')
    <div class="main-login">
       
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card card-bg shadow-lg p-4" style="max-width: 400px; width: 100%;">
                <div class="card-body">
                    <h4 class="text-center mb-4">Entrar na Conta</h4>
                     <x-alert />
                    <form action="{{ route('login.process') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail ou usuário</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn-login">Entrar</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small>Não tem uma conta? <a href="{{ url('/register') }}"
                                class="text-decoration-none text-black fw-bold">Cadastre-se</a></small>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('javascript')
@endsection
