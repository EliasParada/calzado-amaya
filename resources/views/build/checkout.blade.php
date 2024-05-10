@extends('layouts.app')

@section('title')
<title>Envio | Calzado Amaya</title>
@endsection

@section('content')
<div class="container mx-auto p-8">
    <h2 class="text-3xl font-bold mb-4">Enformación de envio</h2>

    <div class="container mx-auto flex">
        <form action="{{ route('checkout.envio') }}" method="POST" class="w-1/2 pl-4 flex items-start justify-start flex-col">
            @csrf
            <h2 class="text-xl font-bold mb-4">Resumen del pedido</h2>
            <div class="w-full flex flex-col gap-2">
                <div class="mb4 flex gap-4">
                    <div class="mb-4 w-full">
                        <label for="nombre" class="block mb-1">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required class="w-full px-3 py-2 border-2 border-black focus:outline-none focus:ring focus:ring-main-yellow">
                    </div>
                    <div class="mb-4 w-full">
                        <label for="apellido" class="block mb-1">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" required class="w-full px-3 py-2 border-2 border-black focus:outline-none focus:ring focus:ring-main-yellow">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="telefono" class="block mb-1">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" required class="w-full px-3 py-2 border-2 border-black focus:outline-none focus:ring focus:ring-main-yellow">
                </div>
                <div class="mb-4">
                    <label for="correo" class="block mb-1">Correo electronico:</label>
                    <input type="text" id="correo" name="correo" required class="w-full px-3 py-2 border-2 border-black focus:outline-none focus:ring focus:ring-main-yellow">
                </div>
                <div class="mb-4">
                    <label for="direccion" class="block mb-1">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" required class="w-full px-3 py-2 border-2 border-black focus:outline-none focus:ring focus:ring-main-yellow">
                </div>
                @if (Auth::check())
                    <div class="mb-4">
                    <input type="checkbox" name="datos_contacto" id="contacto">
                    <label for="contacto">Guardar información de contacto</label>
                    </div>
                @else
                    <a href="{{ route('register') }}">Registrate para gestionar mejor tus pedidos.</a>
                @endif
                <button type="submit" class="bg-white text-black px-4 py-2 border-2 border-black hover:bg-black hover:text-white mt-4 w-full">Continuar</button>
            </div>
        </form>
        <div class="w-1/2 p-4">
            @if(count($carrito) > 0)
                <div class="overflow-x-auto w-full">
                    @foreach($carrito as $item)
                    <div class="flex gap-4 justify-center w-full">
                        <a href="{{ route('producto', $item['producto_id']) }}" class="flex items-center justify-center w-full">
                            @foreach (json_decode($item['imagenes']) as $index => $imagen)
                                @if($index >= 1)
                                    @break
                                @endif
                                <img src="{{ asset('imagenes/' . $imagen) }}" alt="{{ $item['nombre'] }}" class="w-28 h-auto mr-2">
                            @endforeach
                        </a>
                        <div class="flex flex-col w-full">
                            <h3 class="text-xl font-bold">{{ $item['nombre'] }}</h3>
                            <h3 class="">Talla: {{ $item['talla'] }}</h3>
                            <h3 class="">Color: {{ $item['color'] }}</h3>
                            <h3 class="">Cantidad: {{ $item['cantidad'] }}</h3>
                            <h3 class="text-lg font-bold">${{ $item['precio_unidad'] * $item['cantidad'] }}</h3>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
            <p class="mt-4">El carrito está vacío.</p>
            @endif
            <div class="w-full flex flex-col gap-2">
                <div class="mb-2 w-full flex justify-between">
                    <p>Subtotal:</p>
                    <p id="subtotal">${{ $subtotal }}</p>
                </div>
                <div class="mb-2 w-full flex justify-between">
                    <p>Envio:</p>
                    <p id="envio">Por calcular</p>
                </div>
                <div class="border-t border-gray-300 py-2 font-semibold w-full flex justify-between">
                    <p>Total a pagar:</p>
                    <p id="total">{{ $subtotal }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>

</script>
@endsection
