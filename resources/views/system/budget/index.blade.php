@extends('templates.index')

@section('content')
    <div class="container my-5">
        <div class="row d-flex">
            <div class="col-6 my-4 ps-5">
                <h3 class="fw-bold ps-5">Orçamento com Fornecedores</h3>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-end">
                <form class="d-flex justify-content-center me-5" role="search" action="{{ url('/search') }}" method="GET">
                    <div class="position-relative w-100">
                        <i class="fi fi-rr-search position-absolute"
                            style="left: 18px; top: 50%; transform: translateY(-50%); color: gray; z-index: 2;"></i>
                        <input class="form-control search-sm ps-5 me-2" type="search" placeholder="Pesquisar..."
                            aria-label="Buscar" name="q">
                    </div>
                </form>
            </div>
            <h5 class="my-4 ms-5 ps-5" id="results-budget">Resultados da Pesquisa...</h5>
        </div>

        <div class="swiper mySwiper" id="budget-swiper">
            <div class="swiper-wrapper">
                <!-- Amoxicilina - Melhor Preço -->
                <div class="swiper-slide" id="swiper-slide">
                    <div class="card shadow" style="width: 21rem; position: relative;">
                        <div class="best-price">Melhor Preço</div>
                        <div class="card-body">
                            <h5 class="card-title">Special Dog</h5>
                        </div>
                        <img src="{{ asset('assets/img/racao.png') }}"
                            class="card-img-top" alt="Amoxicilina" style="width: 100%;">
                        <div
                            class="card-footer d-flex justify-content-between align-items-center px-3 pb-3 border-0 bg-transparent">
                            <p class="fw-bold fs-5 mb-0">R$ 5.50/unt</p>
                            <button class="btn btn-light fw-semibold">Comprar</button>
                        </div>
                    </div>
                </div>

                <!-- Ibuprofeno -->
                <div class="swiper-slide">
                    <div class="card shadow" style="width: 21rem;">
                        <div class="card-body">
                            <h5 class="card-title">New Dog</h5>
                        </div>
                        <img src="{{ asset('assets/img/racao2.png') }}"
                            class="card-img-top" alt="Ibuprofeno" style="width: 100%;">
                        <div
                            class="card-footer d-flex justify-content-between align-items-center px-3 pb-3 border-0 bg-transparent">
                            <p class="fw-bold fs-5 mb-0">R$ 6.80/unt</p>
                            <button class="btn btn-light fw-semibold">Comprar</button>
                        </div>
                    </div>
                </div>

                <!-- Dipirona -->
                <div class="swiper-slide">
                    <div class="card shadow" style="width: 21rem;">
                        <div class="card-body">
                            <h5 class="card-title">Bravectro</h5>
                        </div>
                        <img src="{{ asset('assets/img/antipulgas.png') }}"
                            class="card-img-top" alt="Dipirona" style="width: 100%;">
                        <div
                            class="card-footer d-flex justify-content-between align-items-center px-3 pb-3 border-0 bg-transparent">
                            <p class="fw-bold fs-5 mb-0">R$ 6.50/unt</p>
                            <button class="btn btn-light fw-semibold">Comprar</button>
                        </div>
                    </div>
                </div>

                <!-- Omeprazol -->
                <div class="swiper-slide">
                    <div class="card shadow" style="width: 21rem;">
                        <div class="card-body">
                            <h5 class="card-title">Arranhadores Miupetz</h5>
                        </div>
                        <img src="{{ asset('assets/img/brinquedo.png') }}"
                            class="card-img-top" alt="Omeprazol" style="width: 100%;">
                        <div
                            class="card-footer d-flex justify-content-between align-items-center px-3 pb-3 border-0 bg-transparent">
                            <p class="fw-bold fs-5 mb-0">R$ 8.00/unt</p>
                            <button class="btn btn-light fw-semibold">Comprar</button>
                        </div>
                    </div>
                </div>

                <!-- Genérico - Maior Preço -->
                <div class="swiper-slide">
                    <div class="card shadow" style="width: 21rem; position: relative;">
                        <div class="worst-price">Maior Preço</div>
                        <div class="card-body">
                            <h5 class="card-title">Beeps</h5>
                        </div>
                        <img src="{{ asset('assets/img/shampoo.png') }}"
                            class="card-img-top" alt="Genérico" style="width: 100%;">
                        <div
                            class="card-footer d-flex justify-content-between align-items-center px-3 pb-3 border-0 bg-transparent">
                            <p class="fw-bold fs-5 mb-0">R$ 10.00/unt</p>
                            <button class="btn btn-light fw-semibold">Comprar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                768: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
                992: {
                    slidesPerView: 2,
                    spaceBetween: 12
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 15
                }
            }
        });
    </script>
@endsection
