@extends('templates.home')

@section('content')
    {{-- @php
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
    @endphp --}}

    <div class="bg-footer text-dark py-3">
        <div class="container d-flex flex-wrap justify-content-center align-items-center gap-3">
            <a href="#" class="footer-button text-decoration-none fs-5">
                <i class="fi fi-rr-menu-burger"></i>
            </a>
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
            <h3>Ofertas da Semana</h3>
            <div class="line-black"></div>
        </div>

        <div class="row p-5">
            <div class="swiper mySwiper" id="mySwiperPrimary">
                <div class="swiper-wrapper">
                     @foreach ($products as $product)
                    @php
                        $image = Str::startsWith($product->image, 'assets')
                            ? asset($product->image)
                            : asset('storage/' . $product->image);
                        $originalPrice = $product->price * 1.2;
                        $discountPercent = round(100 - ($product->price / $originalPrice) * 100);
                    @endphp
                    <div class="swiper-slide">
                        <div class="card h-100">
                            @if ($discountPercent > 0)
                                <div class="discount-badge">
                                    -{{ $discountPercent }}%
                                </div>
                            @endif
                            <img src="{{ $image }}" class="card-img-top" alt="{{ $product->fantasy_name }}">
                            <div class="card-body text-start">
                                <h6 class="mb-2">{{ $product->fantasy_name }}</h6>
                                <span class="text-price-other mb-0">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </span>
                                <p class="fw-bold fs-3 mb-2">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </p>
                                <a href="#" class="btn-buy-home text-center btn-sm">Comprar</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <h3>Todos os Produtos</h3>
            <div class="line-black"></div>
        </div>

        <div class="row p-5">
            <div class="swiper mySwiper" id="mySwiperSecondary">
                <div class="swiper-wrapper">
                    @foreach ($products as $product)
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <img src="{{ $product['image'] }}" class="card-img-top" alt="{{ $product['title'] }}">
                                <div class="card-body text-start">
                                    <h6 class="mb-2">{{ $product['title'] }}</h6>
                                    <p class="fw-bold fs-3 mb-2">
                                        R$ {{ number_format($product['price'], 2, ',', '.') }}
                                    </p>
                                    <a href="#" class="btn-buy-home text-center btn-sm">Comprar</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const swiperPrimary = new Swiper('#mySwiperPrimary', {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                // Assim deixa o carrousel rodando sozinho, para desativar coloque false 
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

        const swiperSecondary = new Swiper('#mySwiperSecondary', {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                // Assim deixa o carrousel rodando sozinho, para desativar coloque false 
                delay: 4000
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
