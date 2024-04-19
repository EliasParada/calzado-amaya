@extends('layouts.app')

@section('title')
<title>Calzado Amaya</title>
@endsection

@section('content')
<div class="container mx-auto p-8">
    <h2 class="text-3xl font-bold mb-4">Carrito de compras</h2>

    <div class="container mx-auto flex">
        <div class="w-1/2 pr-4">
            @if(count($carrito) > 0)
                <div class="overflow-x-auto w-full">
                    @foreach($carrito as $item)
                    <div class="flex gap-4 justify-start w-full">
                        <a href="{{ route('producto', $item['producto_id']) }}" class="flex items-center">
                            @foreach (json_decode($item['imagenes']) as $index => $imagen)
                                @if($index >= 1)
                                    @break
                                @endif
                                <img src="{{ asset('imagenes/' . $imagen) }}" alt="{{ $item['nombre'] }}" class="w-24 h-24 mr-2">
                            @endforeach
                        </a>
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold">{{ $item['nombre'] }}</h3>
                            <h3 class="">Talla: {{ $item['talla'] }}</h3>
                            <h3 class="">Color: {{ $item['color'] }}</h3>
                            <h3 class="">Cantidad:
                                <input type="number" value="{{ $item['cantidad'] }}" min="1" max="{{ $item['cantidad_disponible'] }}"
                                class="w-16 border border-gray-300 rounded-md px-2 py-1"></h3>
                            <h3 class="text-xl font-bold">${{ $item['precio_unidad'] }}</h3>
                        </div>
                        <div class="h-full flex items-end">
                            <form action="{{ route('carrito.eliminar', $item['producto_id']) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-black">Eliminar</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                <form action="{{ route('carrito.vaciar') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-white text-black hover:bg-black hover:text-white border-2 border-black px-4 py-2 my-2">Vaciar Carrito</button>
                </form>
            @else
            <p class="mt-4">El carrito está vacío.</p>
            @endif
        </div>
        <div class="w-1/2 pl-4 flex items-start justify-start flex-col">
            <h2 class="text-xl font-bold mb-4">Resumen del pedido</h2>
            <div class="w-full flex flex-col gap-2">
                <div class="mb-2 w-full flex justify-between">
                    <p>Subtotal:</p>
                    <p>${{ $subtotal }}</p>
                </div>
                <div class="mb-2 w-full flex justify-between">
                    <p>Envio:</p>
                    <p>Por calcular</p>
                </div>
                <div class="border-t border-gray-300 py-2 font-semibold w-full flex justify-between">
                    <p>Total a pagar:</p>
                    <p>{{ $subtotal }}</p>
                </div>
            </ul>
            <button class="bg-white text-black px-4 py-2 border-2 border-black hover:bg-black hover:text-white mt-4 w-full">Continuar con la compra</button>
        </div>
    </div>
</div>
@endsection