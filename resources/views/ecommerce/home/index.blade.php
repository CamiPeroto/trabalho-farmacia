@extends('templates.home')

@section('content')
    @php
        $products = [
            [
                'title' => 'Omeprazol 20mg - 10 cápsulas',
                'price' => 11.9,
                'image' =>
                    'https://airela.com.br/wp-content/uploads/2024/02/ibuprofeno_400mg_ibuprofeno_10capsulas.png',
            ],
            [
                'title' => 'Multivitamínico A-Z - 60 cápsulas',
                'price' => 29.99,
                'image' =>
                    'https://dmvfarma.vtexassets.com/arquivos/ids/271865/DIPIRONA%20500MG%20C20.png.png?v=638827583361130000',
            ],
            [
                'title' => 'Omeprazol 20mg - 10 cápsulas',
                'price' => 11.9,
                'image' =>
                    'https://airela.com.br/wp-content/uploads/2024/02/ibuprofeno_400mg_ibuprofeno_10capsulas.png',
            ],
            [
                'title' => 'Multivitamínico A-Z - 60 cápsulas',
                'price' => 29.99,
                'image' =>
                    'https://dmvfarma.vtexassets.com/arquivos/ids/271865/DIPIRONA%20500MG%20C20.png.png?v=638827583361130000',
            ],
            [
                'title' => 'Omeprazol 20mg - 10 cápsulas',
                'price' => 11.9,
                'image' =>
                    'https://airela.com.br/wp-content/uploads/2024/02/ibuprofeno_400mg_ibuprofeno_10capsulas.png',
            ],
            [
                'title' => 'Multivitamínico A-Z - 60 cápsulas',
                'price' => 29.99,
                'image' =>
                    'https://dmvfarma.vtexassets.com/arquivos/ids/271865/DIPIRONA%20500MG%20C20.png.png?v=638827583361130000',
            ],
        ];
    @endphp

    <div class="bg-footer text-dark py-3">
        <div class="container d-flex flex-wrap justify-content-center gap-3">
            <a href="#" class="px-4 py-2 footer-button text-decoration-none">
                Departamentos
            </a>
            <a href="#" class="px-4 py-2 footer-button text-decoration-none">
                Club
            </a>
            <a href="#" class="px-4 py-2 footer-button text-decoration-none">
                Almanaque
            </a>
            <a href="#" class="px-4 py-2 footer-button text-decoration-none">
                Manipulação
            </a>
            <a href="#" class="px-4 py-2 footer-button text-decoration-none">
                Medicações Especiais
            </a>
        </div>
    </div>

    <div class="container">
        <div class="row p-5">
            <div class="col-4">
                <img src="{{ asset('assets/img/1.png') }}" alt="" class="img-fluid img-banner">
            </div>
            <div class="col-4">
                <img src="{{ asset('assets/img/2.png') }}" alt="" class="img-fluid img-banner">
            </div>
            <div class="col-4">
                <img src="{{ asset('assets/img/3.png') }}" alt="" class="img-fluid img-banner">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <h3>Ofertas da semana</h3>
            <div class="line-black"></div>
        </div>
        <div class="row mt-5">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($products as $product)
                        <div class="swiper-slide">
                            <div class="card">
                                <img src="{{ $product['image'] }}" class="card-img-top">
                                <div class="card-body text-center">
                                    <h6>{{ $product['title'] }}</h6>
                                    <p class="fw-bold text-success">R$ {{ number_format($product['price'], 2, ',', '.') }}
                                    </p>
                                    <a href="#" class="btn btn-primary btn-sm">Comprar</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const swiper = new Swiper('.mySwiper', {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                768: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                },
                1200: {
                    slidesPerView: 4
                }
            }
        });
    </script>
@endsection
