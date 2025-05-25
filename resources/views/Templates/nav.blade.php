@extends('templates.index')

@section('nav')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand me-4" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="150" height="100"
                    class="d-inline-block align-text-top">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between align-items-center" id="navbarContent">

                <form class="d-flex flex-grow-1 justify-content-center mx-3" role="search" action="{{ url('/search') }}"
                    method="GET">
                    <input class="form-control nav-search me-2 w-75" type="search" placeholder="O que deseja?"
                        aria-label="Buscar" name="q">
                </form>

                <div class="d-flex align-items-center justify-content-center">
                    <div class="nav-btn me-4">
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fi fi-rr-user p-2 fw-2"></i>
                            <a href="{{ url('/login') }}" class="link-nav-button">
                                <span class="fw-bold ">Bem-vindo!</span>
                                <span class="small ">Entrar ou cadastrar</span>
                            </a>
                        </div>
                    </div>

                    <a href="{{ url('/register') }}" class="nav-btn text-decoration-none text-dark text-center">
                        <span class="fw-bold ">Carrinho</span>
                        <span class="small ">R$ 00,00</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
@endsection