<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Farmácia Barateira</title>
    <link href="{{ url('assets/img/favicon.png') }}" rel="icon" />
    <link href="{{ url('assets/img/favicon.png') }}" rel="apple-touch-icon" />

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

    <div class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-header">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo da Barateira" class="navbar-brand"
                        height="30" />
                </a>
            </div>
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#submenuPerfil" role="button" aria-expanded="true" aria-controls="submenuPerfil">
                            <i class="fi fi-rr-user"></i>
                            <p>Perfil</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse show" id="submenuPerfil">
                            <ul class="nav nav-collapse">
                                <li class="nav-item">
                                    <a href="#" class="d-flex align-items-center active bg-grey px-2 py-1">
                                        <i class="fi fi-rr-star d-flex m-1"></i>
                                        <span class="ms-1">Vendedor</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="d-flex align-items-center">
                                        <i class="fi fi-rr-star d-flex m-1"></i>
                                        <span>Dados Pessoais</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <i class="fi fi-rr-clock"></i>
                            <p>Histórico de Comissões</p>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ url('/medicines') }}">
                            <i class="fi fi-rr-computer"></i>
                            <p>Sistema</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}">
                            <i class="fi fi-rr-sign-out-alt"></i>
                            <p>Sair</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-panel">
        @yield('content')

        <footer class="footer">
            <div class="container-fluid justify-content-center">
                <nav class="pull-left">
                    <div class="copyright d-flex align-items-center">
                        <i class="fi fi-rr-headphones fs-3 me-3"></i>
                        Problemas ? Fale com nosso suporte: 0800 1234 123
                    </div>
                </nav>
            </div>
        </footer>
    </div>

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
