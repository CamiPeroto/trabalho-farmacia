@extends('templates.home')

@section('content')
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
                                    @auth
                                        <a href="#"
                                            onclick="handleBuy({{ $product->id }}, '{{ $product->fantasy_name }}', {{ $product->price }})"
                                            class="btn-buy-home text-center btn-sm">Comprar</a>
                                    @else
                                        <a href="{{ route('login.index') }}"
                                            class="btn-buy-home text-center btn-sm">Comprar</a>
                                    @endauth
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
                                <img src="{{ $product['image'] }}" class="card-img-top"
                                    alt="{{ $product->fantasy_name }}">
                                <div class="card-body text-start">
                                    <h6 class="mb-2">{{ $product->fantasy_name }}</h6>
                                    <p class="fw-bold fs-3 mb-2">
                                        R$ {{ number_format($product['price'], 2, ',', '.') }}
                                    </p>
                                    @auth
                                        <a href="#"
                                            onclick="handleBuy({{ $product->id }}, '{{ $product->fantasy_name }}', {{ $product->price }})"
                                            class="btn-buy-home text-center btn-sm">Comprar</a>
                                    @else
                                        <a href="{{ route('login.index') }}"
                                            class="btn-buy-home text-center btn-sm">Comprar</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 id="cartOffcanvasLabel" class="fw-bold">Meu Carrinho</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
        </div>
        <div class="offcanvas-body" id="cartItems">
            <div class="alert alert-info text-center" role="alert">
                Seu carrinho está vazio no momento.<br>
                Para adicionar produtos ao carrinho, por favor <a href="{{ url('/login') }}" class="alert-link">Faça
                    Login</a> ou <a href="{{ url('/register') }}" class="alert-link">Cadastre-se</a>
            </div>
        </div>
        <div class="offcanvas-footer p-3 border-top">
            <div class="d-flex justify-content-between mb-3">
                <strong>Total:</strong>
                <span id="cartTotal">R$ 0,00</span>
            </div>

            @auth
                <!-- Usuário logado: botão para finalizar compra -->
                <a href="#" class="btn btn-info w-100">
                    Finalizar Compra
                </a>
            @else
                <!-- Usuário não logado: botão direciona para login -->
                <a href="{{ url('/login') }}" class="btn btn-info w-100">
                    Faça login para finalizar a compra
                </a>
            @endauth
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

        const isLoggedIn = @json(auth()->check());
        let cart = [];
        let cartBadge = document.getElementById('cartBadge');
        let cartSummary = document.getElementById('cartSummary');
        let cartItemsContainer = document.getElementById('cartItems');
        let cartTotal = document.getElementById('cartTotal');

        function handleBuy(id, name, price) {
            const product = {
                id,
                name,
                price
            };

            if (!isLoggedIn) {
                Swal.fire({
                    icon: 'info',
                    title: 'Você precisa estar logado!',
                    text: 'Faça login para adicionar itens ao carrinho.',
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route('login.index') }}';
                    }
                });
            } else {
                addToCart(product);
                let cartOffcanvas = new bootstrap.Offcanvas(document.getElementById('cartOffcanvas'));
                cartOffcanvas.show();
            }
        }

        function addToCart(product) {
            let existingProduct = cart.find(p => p.id === product.id);
            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                cart.push({
                    ...product,
                    quantity: 1
                });
            }
            updateCartUI();
        }

        function updateCartUI() {
            let total = 0;
            let totalQuantity = 0;
            cartItemsContainer.innerHTML = '';

            cart.forEach(product => {
                total += product.price * product.quantity;
                totalQuantity += product.quantity;

                cartItemsContainer.innerHTML += `
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <strong>${product.name}</strong><br>
                        <small>Preço unitário: R$ ${product.price.toFixed(2)}</small>
                    </div>
                    <div class="text-end">
                        <input type="number" min="1" class="form-control form-control-sm mb-2 text-center" style="width: 60px;" 
                            value="${product.quantity}" onchange="updateQuantity(${product.id}, this.value)">
                        <span>Total: R$ ${(product.price * product.quantity).toFixed(2)}</span>
                    </div>
                </div>
                <hr>
            `;
            });

            cartTotal.innerText = `R$ ${total.toFixed(2)}`;
            cartSummary.innerText = `R$ ${total.toFixed(2)}`;

            if (totalQuantity > 0) {
                cartBadge.style.display = 'inline';
                cartBadge.innerText = totalQuantity;
            } else {
                cartBadge.style.display = 'none';
            }
        }

        function updateQuantity(productId, newQuantity) {
            let product = cart.find(p => p.id === productId);
            if (product) {
                product.quantity = parseInt(newQuantity);
                if (product.quantity < 1) {
                    product.quantity = 1;
                }
                updateCartUI();
            }
        }
    </script>
@endsection
