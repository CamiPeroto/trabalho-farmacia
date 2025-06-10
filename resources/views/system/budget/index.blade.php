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
                            <h5 class="card-title">Farmácia Vida</h5>
                        </div>
                        <img src="https://dmvfarma.vtexassets.com/arquivos/ids/249835/AMOXICILINA-CLAV-500-125MG-18CPR-NOVS.jpg?v=638562219948300000"
                            class="card-img-top" alt="Amoxicilina" style="width: 100%;">
                        <div
                            class="card-footer d-flex justify-content-between align-items-center px-3 pb-3 border-0 bg-transparent">
                            <p class="fw-bold fs-5 mb-0">R$:4.50/unt</p>
                            <button class="btn btn-light fw-semibold">Comprar</button>
                        </div>
                    </div>
                </div>

                <!-- Ibuprofeno -->
                <div class="swiper-slide">
                    <div class="card shadow" style="width: 21rem;">
                        <div class="card-body">
                            <h5 class="card-title">Distrimed</h5>
                        </div>
                        <img src="https://io.convertiez.com.br/m/farmaponte/shop/products/images/28148/large/ibuprofeno-100mg-gts-20-ml-med_23432.png"
                            class="card-img-top" alt="Ibuprofeno" style="width: 100%;">
                        <div
                            class="card-footer d-flex justify-content-between align-items-center px-3 pb-3 border-0 bg-transparent">
                            <p class="fw-bold fs-5 mb-0">R$:5.20/unt</p>
                            <button class="btn btn-light fw-semibold">Comprar</button>
                        </div>
                    </div>
                </div>

                <!-- Dipirona -->
                <div class="swiper-slide">
                    <div class="card shadow" style="width: 21rem;">
                        <div class="card-body">
                            <h5 class="card-title">Galindo</h5>
                        </div>
                        <img src="https://guiadafarmacia.com.br/consulta-medicamentos/wp-content/uploads/2021/07/7891058017507.png"
                            class="card-img-top" alt="Dipirona" style="width: 100%;">
                        <div
                            class="card-footer d-flex justify-content-between align-items-center px-3 pb-3 border-0 bg-transparent">
                            <p class="fw-bold fs-5 mb-0">R$:6.50/unt</p>
                            <button class="btn btn-light fw-semibold">Comprar</button>
                        </div>
                    </div>
                </div>

                <!-- Omeprazol -->
                <div class="swiper-slide">
                    <div class="card shadow" style="width: 21rem;">
                        <div class="card-body">
                            <h5 class="card-title">Abafarma</h5>
                        </div>
                        <img src="https://acdn-us.mitiendanube.com/stores/003/033/056/products/78967142008041-0275cf75d329af3c8b16873519841510-480-0.png"
                            class="card-img-top" alt="Omeprazol" style="width: 100%;">
                        <div
                            class="card-footer d-flex justify-content-between align-items-center px-3 pb-3 border-0 bg-transparent">
                            <p class="fw-bold fs-5 mb-0">R$:8.00/unt</p>
                            <button class="btn btn-light fw-semibold">Comprar</button>
                        </div>
                    </div>
                </div>

                <!-- Genérico - Maior Preço -->
                <div class="swiper-slide">
                    <div class="card shadow" style="width: 21rem; position: relative;">
                        <div class="worst-price">Maior Preço</div>
                        <div class="card-body">
                            <h5 class="card-title">Genérico Farma</h5>
                        </div>
                        <img src="https://ultramegapopular.cdn.magazord.com.br/img/2024/05/produto/222/generico-png.png?ims=290x290"
                            class="card-img-top" alt="Genérico" style="width: 100%;">
                        <div
                            class="card-footer d-flex justify-content-between align-items-center px-3 pb-3 border-0 bg-transparent">
                            <p class="fw-bold fs-5 mb-0">R$:9.00/unt</p>
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
