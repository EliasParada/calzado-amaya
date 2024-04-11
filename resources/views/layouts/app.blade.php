<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')

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
                    }
                }
            }
        }
    </script>
</head>
<body>
    <nav id="navbar"
        class="flex justify-around items-end w-100 h-24 box-border p-4 sticky top-0 bg-main-yellow">
        <div
            class="flex flex-col justify-between p-2 box-border">
            <img src="" alt="Logo" srcset="">
            <span>Calzado Amaya</span>
        </div>

        <div
            class="flex justify-between p-2 box-border">
            <span>Inicio</span>
            <span>Categorías</span>
            <span>Promociones</span>
            <span>Sobre Nosotros</span>
            <span>Contacto</span>
        </div>

        <div
            class="flex justify-between p-2 box-border">
            <span>Iniciar Sesión</span>
        </div>
    </nav>
    <main id="content">
        @yield('content')
    </main>
</body>
</html>