<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse | {{ config('app.name') }}</title>
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
<body class="bg-gray-100 font-yaldevi p-4">

    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-md flex flex-col items-center">
            <a href="{{ route('home') }}" class="w-32">
                <img src="{{ asset('img/calzado-amaya-color.svg') }}" alt="Calzado Amaya" class="w-32 h-auto">
            </a>
            <h1 class="text-2xl font-bold mb-4 text-center">{{ config('app.name') }}</h1>

            <form action="{{ route('register.new') }}" method="post" class="w-full">
                @csrf
                <div class="mb-4">
                    <label for="nombre" class="block mb-1 placeholder-main-yellow">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required placeholder="Ingresa tu nombre" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-main-yellow placeholder-gray-500" value="{{ old('nombre') }}">
                    @error('nombre')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="correo" class="block mb-1 placeholder-main-yellow">Correo:</label>
                    <input type="email" id="correo" name="correo" required placeholder="Ingresa tu correo electrónico" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-main-yellow placeholder-gray-500" value="{{ old('correo') }}">
                    @error('correo')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block mb-1 placeholder-main-yellow">Contraseña:</label>
                    <input type="password" id="password" name="password" required placeholder="Ingresa tu contraseña" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-main-yellow placeholder-gray-500">
                    @error('password')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="confirm_password" class="block mb-1 placeholder-main-yellow">Confirmar Contraseña:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirma tu contraseña" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-main-yellow placeholder-gray-500">
                    <div id="password-error" class="text-red-500 mb-4 @error('confirm_password') block @else hidden @enderror">Las contraseñas no coinciden.</div>
                </div>

                


                <div id="password-requirements" class="mb-4">
                    <p class="mb-1">La contraseña debe cumplir con los siguientes requisitos:</p>
                    <ul class="list-disc list-inside">
                        <li id="requirement-length">Al menos 8 caracteres</li>
                        <li id="requirement-uppercase">Al menos una letra mayúscula</li>
                        <li id="requirement-lowercase">Al menos una letra minúscula</li>
                        <li id="requirement-number">Al menos un número</li>
                        <li id="requirement-symbol">Al menos un símbolo</li>
                    </ul>
                </div>

                <div class="w-full flex items-center justify-center">
                    <a href="{{ route('login') }}" class="text-center mb-4 text-main-yellow hover:underline">¿Ya tienes una cuenta?</a>
                </div>

                <button id="submit-btn" type="submit" class="w-full bg-main-yellow text-secondary-black font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out hover:bg-yellow-600 focus:outline-none focus:ring focus:ring-main-yellow" disabled>Registrarse</button>
            </form>
        </div>
    </div>

    <script>
        function validatePassword() {
            let password = document.getElementById("password").value;

            let isLengthValid = password.length >= 8;
            let hasUppercase = /[A-Z]/.test(password);
            let hasLowercase = /[a-z]/.test(password);
            let hasNumber = /\d/.test(password);
            let hasSymbol = /[!@#$%^&*(),.?":{}|<>]/.test(password);

            document.getElementById("requirement-length").classList.toggle("line-through", isLengthValid);
            document.getElementById("requirement-length").classList.toggle("text-yellow-700", isLengthValid);
            document.getElementById("requirement-uppercase").classList.toggle("line-through", hasUppercase);
            document.getElementById("requirement-uppercase").classList.toggle("text-yellow-700", hasUppercase);
            document.getElementById("requirement-lowercase").classList.toggle("line-through", hasLowercase);
            document.getElementById("requirement-lowercase").classList.toggle("text-yellow-700", hasLowercase);
            document.getElementById("requirement-number").classList.toggle("line-through", hasNumber);
            document.getElementById("requirement-number").classList.toggle("text-yellow-700", hasNumber);
            document.getElementById("requirement-symbol").classList.toggle("line-through", hasSymbol);
            document.getElementById("requirement-symbol").classList.toggle("text-yellow-700", hasSymbol);

            let requirementsMet = isLengthValid && hasUppercase && hasLowercase && hasNumber && hasSymbol;

            return requirementsMet;
        }

        function validateForm() {
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("confirm_password").value;

            let passwordsMatch = password === confirmPassword;
            let isPasswordValid = validatePassword();

            document.getElementById("password-error").classList.toggle("hidden", passwordsMatch);

            let submitButton = document.getElementById("submit-btn");
            submitButton.disabled = !(passwordsMatch && isPasswordValid);

            return passwordsMatch && isPasswordValid;
        }

        document.getElementById("password").addEventListener("input", validateForm);
        document.getElementById("confirm_password").addEventListener("input", validateForm);
    </script>
</body>
</html>