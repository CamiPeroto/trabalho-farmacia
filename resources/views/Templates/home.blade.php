<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Farmácia Barateira</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('assets/dist/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/dist/uicons/css/uicons-regular-rounded.css') }}">
    <link rel="stylesheet" href="{{ url('assets/dist/uicons-solid/css/uicons-solid-straight.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11.2.8/swiper-bundle.min.css">

    <link rel="stylesheet" href="{{ url('assets/vendor/ckeditor5.css') }}">

    <link rel="stylesheet" href="{{ url('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/styles.css') }}">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand me-4" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="150" height="50"
                    class="d-inline-block align-text-top">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarContent">

                <form class="d-flex flex-grow-1 justify-content-center mx-3" role="search"
                    action="{{ url('/search') }}" method="GET">
                    <input class="form-control nav-search me-2 w-75" type="search" placeholder="O que deseja?"
                        aria-label="Buscar" name="q">
                </form>

                <div class="d-flex align-items-center justify-content-center">
                    <a href="{{ url('/login') }}">
                        <div class="nav-btn me-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="fi fi-rr-user p-2 mr-4 fw-2"></i>
                                <div class="link-nav-button">
                                    <span class="fw-bold ">Bem-vindo!</span>
                                    <span class="small ">Entrar ou cadastrar</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="#">
                        <div class="nav-btn-card me-4">
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="fi fi-rr-shopping-cart pe-3 fw-2"></i>
                                <div class="link-nav-button">
                                    <span class="fw-bold ">Carrinho</span>
                                    <span class="small ">R$ 00,00</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </nav>

    @yield('content')

    <footer>
        <div class="bg-footer text-dark py-3">
            <div class="container d-flex align-items-center">
                <i class="fi fi-rr-headphones fs-3 me-3"></i>
                <span>Problemas? Fale com nosso suporte: 0800 1234 123</span>
            </div>
        </div>

        <div class="container py-4">
            <div class="row text-center text-md-start">
                <div class="col-md-3 col-6 mb-3">
                    <h5 class="bold">Institucional</h5>
                    <a href="#" class="text-decoration-none footer-button">
                        <p>Sobre</p>
                    </a>
                    <a href="#" class="text-decoration-none footer-button">
                        <p>Nossas lojas</p>
                    </a>
                    <a href="#" class="text-decoration-none footer-button">
                        <p>Trabalhe conosco</p>
                    </a>
                    <a href="#" class="text-decoration-none footer-button">
                        <p>Fale conosco</p>
                    </a>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <h5>Atendimento</h5>
                    <p class="text-orange"> (42) 4004-4041 </p>
                    <p class="mb-1">
                        Seg a Sáb - 8h00 às 23h00
                    </p>
                    <p>
                        Dom e feriados - 8h00 às 22h00
                    </p>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <h5>Suporte </h5>
                    <a href="#" class="text-decoration-none footer-button">
                        <p>Prazo de entrega</p>
                    </a>
                    <a href="#" class="text-decoration-none footer-button">
                        <p>Reembolso</p>
                    </a>
                    <a href="#" class="text-decoration-none footer-button">
                        <p>Troca e devolução</p>
                    </a>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <img src="{{ asset('assets/img/anvisa.png') }}" alt="" class="img-footer">
                </div>
            </div>
        </div>

        <div class="bg-light py-2">
            <div class="container text-center">
                <small class="text-muted">© {{ date('Y') }} Copyright ©️ 2025 Fármacias Barateira - Todos os
                    direitos reservados. RAZÃO SOCIAL | FÁRMACIAS E DROGARIAS BARATEIRA |CNPJ: 12.123.123/1234-12 | End:
                    Av. Marechal Floriano Peixoto nº 999 - Hauer - Ponta Grossa - PR| CEP:84123-000 Farmacêutico
                    Responsável: Conrado Maximiano Cruz, CRF/PR Nº 123456 OBS: "Preços exclusivos para produtos
                    comercializados na Loja Virtual da Fármacias Barateira." Encarregado pelo tratamento de dados
                    pessoais (DPO) | Camila Peroto | E-mail: dpo.lgpd@abarateira.com.br.</small>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/dist/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/dist/js/jquery_mask.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>

    <script src="{{ asset('assets/dist/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="  https://cdn.jsdelivr.net/npm/swiper@11.2.8/swiper-bundle.min.js "></script>

    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    <script src="{{ asset('assets/js/scripts.js') }}"></script>

    <script>
        @if (Session::has('success'))
            Swal.fire({
                position: "top-center",
                icon: 'success',
                title: 'Sucesso!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        @if (Session::has('error'))
            Swal.fire({
                position: "top-center",
                icon: 'error',
                title: 'Erro!',
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        @if (Session::has('info'))
            Swal.fire({
                position: "top-center",
                icon: 'info',
                title: 'Info',
                text: "{{ session('info') }}",
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        @if (Session::has('warning'))
            Swal.fire({
                position: "top-center",
                icon: 'warning',
                title: 'Aviso!',
                text: "{{ session('warning') }}",
                showConfirmButton: false,
                timer: 1500
            });
        @endif
    </script>
    @yield('javascript')
</body>

</html>
