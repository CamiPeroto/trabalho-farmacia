@extends('templates.login')

@section('content')
    <div class="main-login">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card card-bg shadow-lg p-4" style="max-width: 450px; width: 100%;">
                <div class="card-body">
                    <h4 class="text-center mb-4">Criar Conta</h4>

                    <form action="{{ url('/register') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome completo</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span class="position-absolute top-60 end-0 me-3"
                                onclick="togglePassword('password', this)" style="cursor: pointer;">
                                <i class="fi fi-rr-eye"></i>
                            </span>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                            <span class="position-absolute top-60 end-0 me-3"
                                onclick="togglePassword('password_confirmation', this)" style="cursor: pointer;">
                                <i class="fi fi-rr-eye"></i>
                            </span>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn-login">Cadastrar</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small>Já tem uma conta? <a href="{{ url('/login') }}" class="text-decoration-none text-black fw-bold">Entrar</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        function togglePassword(fieldId, iconElement) {
            const input = document.getElementById(fieldId);
            const icon = iconElement.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fi-rr-eye');
                icon.classList.add('fi-rr-eye-crossed');
            } else {
                input.type = "password";
                icon.classList.remove('fi-rr-eye-crossed');
                icon.classList.add('fi-rr-eye');
            }
        }
    </script>
@endsection
