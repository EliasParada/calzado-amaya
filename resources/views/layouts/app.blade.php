<!DOCTYPE html>
<html lang="en" class="box-border h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/calzado-amaya-color.svg') }}" type="image/x-icon">
    @yield('title')
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
</head>
<body class="font-yaldevi box-border h-full">
    <nav id="navbar"
        class="flex justify-around items-end w-full h-16 box-border py-2 sticky top-0 bg-main-yellow font-semibold">
        <a href="{{ route('home') }}"
            class="flex flex-col justify-between h-full box-border items-center">
            <img src="{{ asset('img/calzado-amaya-color.svg') }}" alt="Calzado Amaya" class="w-10 h-auto">
            <span>Calzado Amaya</span>
        </a>

        <div
            class="hidden md:flex justify-between box-border space-x-4">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('categorias') }}">Categorías</a>
            <a href="{{ route('productos') }}">Productos</a>
            <a href="{{ route('categorias') }}">Categorías</a>
            <a href="{{ route('promo') }}">Promociones</a>
            <a href="">Sobre Nosotros</a>
            <a href="">Contacto</a>
        </div>

        <div
            class="hidden md:flex justify-between box-border space-x-4 items-end">
            <form action="#" method="GET">
                <input type="text" name="search" placeholder="Buscar" class="rounded-md px-4 py-2 outline-none focus:ring-2 focus:ring-main-yellow">
                <button type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <a href="#">
                <i class="fas fa-shopping-bag"></i>
            </a>
            @if(Auth::check())
                <div class="relative">
                    <button class="account-btn focus:outline-none">
                        <i class="fas fa-user"></i> Cuenta
                    </button>
                    <ul class="account-menu absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg overflow-hidden hidden">
                        <li>
                            <a href="" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                                {{ Auth::user()->nombre }}
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full h-full px-4 py-2 text-red-600 hover:text-red-800 hover:bg-gray-200 focus:outline-none">
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
    </nav>
    <main id="content" class="w-full p-4">
        @yield('content')
    </main>
    <footer class="bg-gray-200 py-8 px-4">
        <div class="max-w-6xl mx-auto flex flex-wrap justify-between">
            <div class="w-full md:w-1/2 mb-4 md:mb-0 md:px-4">
                <h2 class="text-4xl font-semibold mb-2">Suscríbete a nuestro boletín</h2>
                <p class="mb-4">Recibe las últimas noticias y ofertas especiales directamente en tu bandeja de entrada.</p>
                <form action="#" method="POST" class="flex">
                    <input type="email" name="email" autocomplete="email" placeholder="Tu correo electrónico" class="w-full rounded-l-md px-4 py-2 outline-none focus:ring-2 focus:ring-main-yellow">
                    <button type="submit" class="bg-main-yellow text-white px-4 py-2 rounded-r-md">Suscribirse</button>
                </form>
            </div>

            <div class="w-full md:w-1/2">
                <div class="flex justify-between">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Categorías</h3>
                        <ul>
                            <!-- <li><a href="#">Zapatos de Mujer</a></li>
                            <li><a href="#">Zapatos de Hombre</a></li>
                            <li><a href="#">Zapatos para Niños</a></li> -->
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
                        <a href="#"><i class="fa-brands fa-instagram"></i></a> 
                        <a href="#"><i class="fa-brands fa-facebook"></i></a> 
                        <a href="#"><i class="fa-regular fa-envelope"></i></a> 
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @yield('script')
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
    @endif
</body>
</html>