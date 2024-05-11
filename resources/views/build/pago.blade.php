@extends('layouts.app')

@section('title')
<title>Pago exitoso | Calzado Amaya</title>
@endsection

@section('content')
    <div class="max-w-md mx-auto bg-white p-8">
        <h2 class="text-3xl font-bold mb-6 text-center">¡Pago exitoso!</h2>
        <div class="mb-6">
            <p class="text-lg mb-2">Fecha:</p>
            <p class="text-gray-700">{{ $compra->fecha_compra }}</p>
        </div>
        <div class="mb-6">
            <p class="text-lg mb-2">Número de factura:</p>
            <p class="text-gray-700">{{ $compra->factura_nombre }}</p>
        </div>
        <div class="mb-6">
            <p class="text-lg mb-2">Cliente:</p>
            <p class="text-gray-700">{{ $compra->nombres }}, {{ $compra->apellidos }}</p>
        </div>
        <div class="mb-6">
            <p class="text-lg mb-2">Correo electronico del cliente:</p>
            <p class="text-gray-700">{{ $compra->correo }}</p>
        </div>
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-2">Detalles de la compra:</h3>
            <div class="border-t border-gray-400 py-2">
                @forelse ($compra->detalle as $producto)
                <div class="flex justify-between items-center mb-2">
                    <div class="flex items-center">
                        <p class="mr-4">{{ $producto->productos->nombre }}</p>
                        <p class="font-bold mr-4">X</p>
                        <p class="mr-4">{{ $producto->cantidad }}</p>
                    </div>
                    <p>{{ $producto->cantidad * $producto->productos->precio_venta - $producto->descuento }}</p>
                </div>
                @empty
                <p>No hay productos en esta compra.</p>
                @endforelse
            </div>
        </div>
        <div class="mb-6 flex justify-between">
            <p class="text-lg">Envio:</p>
            <p class="text-gray-700">{{ $compra->precio_envio }}</p>
        </div>
        <div class="mb-6 flex justify-between">
            <p class="text-lg">Total:</p>
            <p class="text-gray-700">{{ $compra->precio_neto }}</p>
        </div>
        <p class="text-center text-gray-600">¡Gracias por tu compra!</p>
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="bg-black text-white px-4 py-2">Volver a la página principal</a>
        </div>
    </div>
@endsection