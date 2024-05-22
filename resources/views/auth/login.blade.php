<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | {{ config('app.name') }}</title>
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
        .checkbox {
            display: inline-block;
            width: 1.25em;
            height: 1.25em;
            border: 2px solid #D1D5DB;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.2s, border-color 0.2s;
        }

        input[type="checkbox"].hidden + .checkbox {
            background-color: #fff;
        }

        input[type="checkbox"].hidden:checked + .checkbox {
            background-color: #E5BD35;
            border-color: #E5BD35;
        }

        input[type="checkbox"].hidden:checked + .checkbox::after {
            color: #fff;
        }
    </style>
</head>
<body class="bg-gray-100 font-yaldevi p-4">

<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-md flex flex-col items-center">
        <a href="{{ route('home') }}" class="w-32">
            <img src="{{ asset('img/calzado-amaya-color.svg') }}" alt="Calzado Amaya" class="w-32 h-auto">
        </a>
        <h1 class="text-2xl font-bold mb-4 text-center">{{ config('app.name') }}</h1>

        <form action="{{ route('login.new') }}" method="post" class="w-full">
            @csrf
            <div class="mb-4">
                <label for="correo" class="block mb-1">Correo:</label>
                <input type="text" id="correo" name="correo" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-main-yellow">
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-1">Contraseña:</label>
                <input type="password" id="password" name="password" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-main-yellow">
            </div>

            <div class="mb-4 flex items-center">
                <label for="remember" class="text-sm flex items-start cursor-pointer">
                    <input type="checkbox" id="remember" name="remember" class="hidden">
                    <div class="checkbox text-white flex justify-center items-center mr-2 bg-gray-500 rounded-md transition-colors duration-300 ease-in-out hover:bg-main-yellow">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <p>Recuérdame</p>
                </label>
            </div>

            <div class="w-full flex items-center justify-center">
                <a href="{{ route('register') }}" class="text-center mb-4 text-main-yellow hover:underline">¿Aún no tienes una cuenta?</a>
            </div>

            <button type="submit" class="w-full bg-main-yellow text-secondary-black font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out hover:bg-yellow-500 focus:outline-none focus:ring focus:ring-main-yellow">Iniciar Sesión</button>
        </form>
    </div>
</div>
</html>