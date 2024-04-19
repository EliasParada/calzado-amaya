@extends('layouts.app')

@section('title')
    <title>{{ $producto->nombre }} | {{ config('app.name') }}</title>
    <style>
        input[type="radio"]:checked + label {
            background-color: black;
            color: white;
        }
    </style>
@endsection

@section('content')
@php
$colores = ['Rojo', 'Verde', 'Azul'];

$tallas = [
    [24,25,26,27,28,29,30,31,32],
    [35,36,37,38,39,40,41,42,43]
];
@endphp
    <div class="flex justify-center mt-8">
        <form action="{{ route('carrito.store') }}" method="POST" class="w-3/4 px-4 flex gap-4">
            @csrf
            <input type="hidden" name="producto_id" value="{{ $producto->producto_id }}">
            <div class="w-2/4 grid grid-cols-2 gap-4">
                @foreach (json_decode($producto->imagenes) as $index => $imagen)
                    <img src="{{ asset('imagenes/' . $imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-auto mb-4">
                @endforeach
            </div>
            <div class="w-2/4 p-4 flex flex-col gap-4">
                <div class="flex flex-col">
                    <h2 class="text-3xl font-bold">{{ $producto->nombre }}</h2>
                    <span class="text-gray-600">${{ $producto->precio_venta }}</span>
                </div>

                <p class="font-lg">{{ $producto->descripcion }}</p>
                <div>
                    <p>Talla</p>
                    <div class="flex gap-4">
                        @foreach ($tallas as $grupoIndex => $grupo)
                            @foreach ($grupo as $tallaIndex => $talla)
                                @if ($producto->tallas && in_array($talla, json_decode($producto->tallas)))
                                    <input type="radio" id="tallas-{{ $grupoIndex }}-{{ $tallaIndex }}" name="talla" value="{{ $talla }}" class="mr-2 hidden">
                                    <label for="tallas-{{ $grupoIndex }}-{{ $tallaIndex }}" class="flex items-center block border-2 border-black text-black py-2 px-4 hover:bg-black hover:text-white cursor-pointer">
                                        <span>{{ $talla }}</span>
                                    </label>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div>
                    <p>Color</p>
                    <div class="flex gap-4">
                        @foreach ($colores as $index => $color)
                            @if ($producto->colores && in_array($color, json_decode($producto->colores)))
                                <input type="radio" id="color-{{ $index }}" name="color" value="{{ $color }}" class="mr-2 hidden">
                                <label for="color-{{ $index }}" class="flex items-center block border-2 border-black text-black py-2 px-4 hover:bg-black hover:text-white cursor-pointer">
                                    <span>{{ $color }}</span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>
                <p class="text-gray-600">Existencia: {{ $producto->existencia }}</p>
                <div class="w-full flex gap-4 justicy-end items-end">
                    <button class="w-2/4 text-bacl px-4 py-2 border-2 border-black hover:bg-black hover:text-white">Agregar al carrito</button>
                    <div class="w-1/4 flex flex-col gap-2">
                        <p>Cantidad</p>
                        <input type="number" id="quantity" name="cantidad" class="border-black border-2 border-black px-3 py-2" min="1" max="{{ $producto->existencia }}" placeholder="Cantidad">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
