<!DOCTYPE html>
<html lang="en" class="box-border h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/calzado-amaya-color.svg') }}" type="image/x-icon">
    @yield('title')
    <meta property="og:image" content="https://calzadoamaya.com/img/calzado-amaya.png"/>
    <meta property="og:title" content="Calzado Amaya" />
    <meta property="og:description" content="Confort en cada paso." />
    <meta
        name="description"
        content="Calzado Amaya, Confort en cada paso.">
    <meta property="og:url" content="https://calzadoamaya.com/" />
    <meta property="og:type" content="website" />
    <meta name="keywords" content="Calzado, Calzado Amaya, Amaya" />

    <script src="https://kit.fontawesome.com/d36239a715.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yaldevi:wght@200..700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        main: {
                            'red': '#940809',
                            'orange': '#F84E29',
                            'yellow': '#E5BD35',
                        },
                        secondary: {
                            'white': '#ffffff',
                            'black': '#000000',
                        }
                    },
                    fontFamily: {
                        yaldevi: 'Yaldevi, sans-serif'
                    }
                }
            }
        }
    </script>
    <style>
        .fixed {
            transition: all 1s;
        }
        .alert {
            transform: translateX(-100%);
        }
        .slide-in {
            transform: translateX(30%) !important;
        }
        .slide-out {
            transform: translateX(-100%) !important;
        }
    </style>
</head>
<body class="font-yaldevi box-border h-full">
    <nav id="navbar" class="flex justify-around items-center md:items-end w-full h-auto md:h-16 box-border py-2 sticky top-0 z-10 bg-main-yellow font-semibold">
        <a href="{{ route('home') }}" class="flex flex-col justify-between h-full box-border items-center">
            <img src="{{ asset('img/calzado-amaya.png') }}" alt="Calzado Amaya" class="w-10 h-auto">
            <span>Calzado Amaya</span>
        </a>

        <div class="hidden md:flex md:flex justify-between box-border space-x-4">
            @if(Auth::check() && Auth::user()->administrador)
                <a href="{{ route('home') }}">Tablero</a>
                <a href="{{ route('productos') }}">Productos</a>
                <a href="{{ route('categorias') }}">Categorías</a>
                <a href="{{ route('promo') }}">Promociones</a>
                <a href="{{ route('pedidos') }}">Pedidos</a>
            @else
                <a href="{{ route('home') }}">Inicio</a>
                <a href="{{ route('categorias') }}">Catálogo</a>
                <a href="{{ route('promo') }}">Promociones</a>
                <a href="{{ route('nosotros') }}">Sobre Nosotros</a>
                <a href="{{ route('contacto') }}">Contacto</a>
            @endif
        </div>

        <div class="hidden md:flex justify-between box-border space-x-4 items-end">
            <form action="/categorias/" method="GET" class="flex items-end justify-between gap-2">
                <input type="text" name="search" placeholder="Buscar" class="bg-main-yellow border-0 border-b-2 border-gray-600 placeholder-gray-600 px-4 py-2 w-24 outline-none">
                <button type="submit" class="text-xl">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <a href="/carrito/" class="text-xl relative">
                <i class="fas fa-shopping-bag"></i>
                @php
                    $totalProductos = 0;
                    if($carrito) {
                        foreach ($carrito as $producto) {
                            $totalProductos += $producto['cantidad'];
                        }
                    }
                @endphp
                @if($carrito && $totalProductos > 0)
                    <span class="absolute -top-1 -right-3 bg-red-500 text-white w-5 h-5 flex items-center justify-center rounded-full text-xs"> {{ $totalProductos }} </span>
                @endif
            </a>
            <!-- A ver -->
            @if(Auth::check())
                <div class="relative">
                    <button class="account-btn focus:outline-none text-xl">
                        <i class="fas fa-user"></i> Cuenta
                    </button>
                    <ul class="account-menu absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg overflow-hidden hidden">
                        <li>
                            <a href="" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                                {{ Auth::user()->nombre }}
                            </a>
                        </li>
                        @if (!Auth::user()->administrador)
                        <li>
                            <a href="{{ route('historial.pedidos', Auth::user()->nombre) }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                                Historial de pedidos
                            </a>
                        </li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full h-full px-4 py-2 text-red-600 text-start hover:text-red-800 hover:bg-gray-200 focus:outline-none">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}">Iniciar Sesión</a>
            @endif
        </div>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-xl focus:outline-none" id="mobile-menu-button">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <div id="mobile-menu" class="fixed inset-y-0 left-0 bg-white w-64 transform -translate-x-full transition-transform duration-300 ease-in-out z-20">
        <div class="flex flex-col p-4">
            <button id="close-mobile-menu" class="self-end text-xl focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
            <div class="flex flex-col space-y-4 mt-4">
                @if(Auth::check() && Auth::user()->administrador)
                    <a href="{{ route('home') }}">Tablero</a>
                    <a href="{{ route('productos') }}">Productos</a>
                    <a href="{{ route('categorias') }}">Categorías</a>
                    <a href="{{ route('promo') }}">Promociones</a>
                    <a href="{{ route('pedidos') }}">Pedidos</a>
                @else
                    <a href="{{ route('home') }}">Inicio</a>
                    <a href="{{ route('categorias') }}">Catálogo</a>
                    <a href="{{ route('promo') }}">Promociones</a>
                    <a href="{{ route('nosotros') }}">Sobre Nosotros</a>
                    <a href="{{ route('contacto') }}">Contacto</a>
                @endif
                <form action="/categorias/" method="GET" class="flex items-center justify-between gap-2">
                    <input type="text" name="search" placeholder="Buscar" class="bg-main-yellow border-0 border-b-2 border-gray-600 placeholder-gray-600 px-4 py-2 w-full outline-none">
                    <button type="submit" class="text-xl">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <a href="/carrito/" class="text-xl relative">
                    <i class="fas fa-shopping-bag"></i>
                    @php
                        $totalProductos = 0;
                        if($carrito) {
                            foreach ($carrito as $producto) {
                                $totalProductos += $producto['cantidad'];
                            }
                        }
                    @endphp
                    @if($carrito && $totalProductos > 0)
                        <span class="absolute -top-1 -right-3 bg-red-500 text-white w-5 h-5 flex items-center justify-center rounded-full text-xs"> {{ $totalProductos }} </span>
                    @endif
                </a>
                @if(Auth::check())
                    <div class="relative">
                        <button class="focus:outline-none text-xl">
                            <i class="fas fa-user"></i> Cuenta
                        </button>
                        <ul class="right-0 pt-2 pl-2 border-box w-full">
                            <li>
                                <a href="" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                                    {{ Auth::user()->nombre }}
                                </a>
                            </li>
                            @if (!Auth::user()->administrador)
                            <li>
                                <a href="{{ route('historial.pedidos', Auth::user()->nombre) }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                                    Historial de pedidos
                                </a>
                            </li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full h-full px-4 py-2 text-red-600 text-start hover:text-red-800 hover:bg-gray-200 focus:outline-none">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}">Iniciar Sesión</a>
                @endif
            </div>
        </div>
    </div>

    
    <main id="content" class="w-full">
        @yield('content')
    </main>
    
    @include('layouts.alertas')
    
    <footer class="bg-gray-200">
        <div class="max-w-6xl mx-auto flex flex-wrap justify-between py-24 px-4">
            <div class="w-full md:w-1/2 mb-4 md:mb-0 md:px-4">
                <h2 class="text-4xl font-semibold mb-2">Suscríbete a nuestro boletín</h2>
                <p class="mb-4">Recibe las últimas noticias y ofertas especiales directamente en tu bandeja de entrada.</p>
                <form action="#" method="POST" class="flex">
                    <input type="email" name="email" autocomplete="email" placeholder="Tu correo electrónico" class="w-full rounded-l-md px-4 py-2 outline-none focus:ring-2 focus:ring-main-yellow">
                    <button type="submit" class="bg-main-yellow text-white px-4 py-2 rounded-r-md">Suscribirse</button>
                </form>
            </div>

            <div class="w-full md:w-1/2">
                <div class="flex justify-evenly">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Categorías</h3>
                        <ul>
                            @foreach($categorias as $categoria)
                                <li><a href="#">{{ $categoria->nombre }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Sobre Nosotros</h3>
                        <ul>
                            <li><a href="#">Acuerdos de uso</a></li>
                            <li><a href="#">Términos y condiciones</a></li>
                            <li><a href="#">Métodos de pago</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2">Contacto</h3>
                        <a target="_blank" href="https://www.instagram.com/calzadoamaya/" class="text-black hover:text-main-orange font-lg"><i class="fa-brands fa-instagram"></i></a> 
                        <a target="_blank" href="https://www.facebook.com/profile.php?id=61558141000631" class="text-black hover:text-main-orange font-lg"><i class="fa-brands fa-facebook"></i></a> 
                        <a target="_blank" href="mailto:contacto@calzadoamaya.com" class="text-black hover:text-main-orange font-lg"><i class="fa-regular fa-envelope"></i></a> 
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-black text-white font-semibold uppercase p-2 text-center">
            todos los derechos reserevados. calzado amaya © 2024
        </div>
    </footer>

    @yield('script')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mobileMenuButton = document.getElementById("mobile-menu-button");
            const closeMobileMenuButton = document.getElementById("close-mobile-menu");
            const mobileMenu = document.getElementById("mobile-menu");

            mobileMenuButton.addEventListener("click", function() {
                mobileMenu.classList.toggle("-translate-x-full");
            });

            closeMobileMenuButton.addEventListener("click", function() {
                mobileMenu.classList.toggle("-translate-x-full");
            });
        });
    </script>

    @if(Auth::check())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const accountButton = document.querySelector(".account-btn");
                const accountMenu = document.querySelector(".account-menu");

                accountButton.addEventListener("click", function() {
                    accountMenu.classList.toggle("hidden");
                });

                document.addEventListener("click", function(event) {
                if (!event.target.closest(".account-btn")) {
                    accountMenu.classList.add("hidden");
                }
            });
                
                accountMenu.addEventListener("click", function(event) {
                    event.stopPropagation();
                });
            });
        </script>
    @else
    <script>
            document.addEventListener("DOMContentLoaded", function() {
                const alerts = [
                    { id: 'login-alert', shownKey: 'loginAlertShown' },
                    { id: 'points-alert', shownKey: 'pointsAlertShown' },
                    { id: 'launch-day1-alert', shownKey: 'launchDay1AlertShown' },
                    { id: 'launch-day2-alert', shownKey: 'launchDay2AlertShown' }
                ];

                function showAlert(index) {
                    if (index >= alerts.length) return;

                    const alert = alerts[index];
                    const alertElement = document.getElementById(alert.id);

                    if (localStorage.getItem(alert.shownKey)) {
                        showAlert(index + 1);
                        return;
                    }

                    alertElement.classList.add('slide-in');
                }

                window.closeAlert = function(alertId) {
                    const alert = alerts.find(alert => alert.id === alertId);
                    const alertElement = document.getElementById(alertId);

                    alertElement.classList.add('slide-out');
                    setTimeout(() => {
                        localStorage.setItem(alert.shownKey, 'true');
                        const nextAlertIndex = alerts.findIndex(a => a.id === alertId) + 1;
                        showAlert(nextAlertIndex);
                    }, 1000);
                };

                showAlert(0);
            });
        </script>
    @endif
</body>
</html>