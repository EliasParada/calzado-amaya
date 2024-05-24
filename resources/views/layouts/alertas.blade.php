@if (!Auth::check())
    <div id="login-alert" class="alert fixed bottom-10 bg-gradient-to-tr from-main-orange to-main-yellow rounded-lg p-8 w-3/4 md:w-1/4 right-1/3 z-50">
        <div class="text-white">
            <h2 class="text-2xl mb-4">Inicia sesión</h2>
            <form action="{{ route('login') }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="correo" class="block mb-1">Correo:</label>
                    <input type="email" name="correo" id="correo" class="text-black w-full rounded-md border-2 border-white p-2 focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-1">Contraseña:</label>
                    <input type="password" name="password" id="password" class="text-black w-full rounded-md border-2 border-white p-2 focus:outline-none" required>
                </div>
                <button type="submit" class="bg-white text-main-orange py-2 px-4 rounded-md hover:bg-gray-100 hover:text-orange-700">Iniciar sesión</button>
            </form>
            <p class="text-sm">¿No tienes una cuenta? <a href="{{ route('register') }}" class="font-bold">Crea una</a> para ganar puntos.</p>
        </div>
        <button class="absolute top-0 right-0 mt-2 mr-2 text-white" onclick="closeAlert('login-alert')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div id="points-alert" class="alert fixed bottom-10 bg-gradient-to-tr from-main-orange to-main-yellow rounded-lg p-8 w-3/4 md:w-1/4 right-1/3 z-50">
        <div class="text-white">
            <h2 class="text-2xl mb-4 font-bold">¡Canjea puntos por descuentos!</h2>
            <p class="text-lg mb-4">Gana puntos con cada compra y utilízalos para obtener descuentos en tus futuras compras. ¡Es fácil y rápido!</p>
            <ul class="mb-4 list-disc list-inside">
                <li>Compra entre $20.00 y $25.00 y acumula el 1% en puntos.</li>
                <li>Compra $26.00 o más y acumula el 2% en puntos.</li>
                <li>¡Cada 100 puntos valen $1.00!</li>
            </ul>
            <p class="text-xs">
                <span class="font-bold">Restricciones:</span> 
                Canjea a partir de 700 puntos. El descuento máximo es del 15% del total de tu compra. No aplica a compras con descuento ya incluido.
            </p>
        </div>
        <button class="absolute top-0 right-0 mt-2 mr-2 text-white" onclick="closeAlert('points-alert')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div id="launch-day1-alert" class="alert fixed bottom-10 bg-gradient-to-tr from-main-orange to-main-yellow rounded-lg p-8 w-3/4 md:w-1/4 right-1/3 z-50">
        <div class="text-white">
            <h2 class="text-2xl mb-4 font-bold">¡Gran lanzamiento de Calzado Amaya!</h2>
            <p class="text-lg mb-4">Estamos emocionados de anunciar el lanzamiento de nuestra tienda virtual.</p>
            <ul class="mb-4 list-disc list-inside">
                <li>Envíos gratis en tu primera compra de $20.00 o más.</li>
                <li>Válido solo para los primeros 50 usuarios registrados.</li>
            </ul>
        </div>
        <button class="absolute top-0 right-0 mt-2 mr-2 text-white" onclick="closeAlert('launch-day1-alert')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div id="launch-day2-alert" class="alert fixed bottom-10 bg-gradient-to-tr from-main-orange to-main-yellow rounded-lg p-8 w-3/4 md:w-1/4 right-1/3 z-50">
        <div class="text-white">
            <h2 class="text-2xl mb-4 font-bold">¡Segundo día de lanzamiento!</h2>
            <p class="text-lg mb-4">Continuamos celebrando con descuentos en envíos para nuestros primeros clientes.</p>
            <ul class="mb-4 list-disc list-inside">
                <li>Envíos a mitad de precio en tu primera compra de $20.00 o más.</li>
                <li>Válido solo para los primeros 50 usuarios registrados.</li>
            </ul>
        </div>
        <button class="absolute top-0 right-0 mt-2 mr-2 text-white" onclick="closeAlert('launch-day2-alert')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif