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
$colores = ['Rojo', 'Azul', 'Blanco', 'Café', 'Morado', 'Beige', 'Gris', 'Rosado', 'Anaranjado', 'Ocre', 'Negro'];

$tallas = [
    [24, 25, 26, 27, 28, 29, 30, 31, 32],
    [35, 36, 37, 38, 39, 40, 41, 42, 43]
];
@endphp
<div class="flex flex-col md:flex-row justify-center mt-8 w-full px-4 md:px-8">
    <form action="{{ route('carrito.store') }}" method="POST" class="w-full md:w-3/4 lg:w-2/3 flex flex-col md:flex-row gap-4">
        @csrf
        <input type="hidden" name="producto_id" value="{{ $producto->producto_id }}">
        <div class="md:w-2/4 grid grid-cols-1 gap-4">
            @foreach (json_decode($producto->imagenes) as $index => $imagen)
                <img src="{{ asset('imagenes/' . $imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-auto mb-4">
            @endforeach
        </div>
        <div class="md:w-2/4 p-4 flex flex-col gap-4">
            <div class="flex flex-col">
                <h2 class="text-2xl md:text-3xl font-bold">{{ $producto->nombre }}</h2>
                @if ($producto->descuento)
                    <p><span class="text-base line-through text-gray-200">${{ $producto->precio_venta }}</span> <b class="text-lg md:text-xl text-yellow-500 font-bold">${{ number_format($producto->precio_venta - ($producto->descuento->descuento * $producto->precio_venta), 2) }}</b></p>
                @else
                    <p class="text-gray-600 text-lg">${{ $producto->precio_venta }}</p>
                @endif
            </div>
            <p class="text-lg">{{ $producto->descripcion }}</p>
            <div>
                <p class="text-lg font-semibold">Talla</p>
                <div class="flex gap-4 flex-wrap">
                    @php $checkedAlready = true; @endphp
                    @foreach ($tallas as $grupoIndex => $grupo)
                        @foreach ($grupo as $tallaIndex => $talla)
                            @if ($producto->tallas && in_array($talla, json_decode($producto->tallas)))
                                <input type="radio" id="tallas-{{ $grupoIndex }}-{{ $tallaIndex }}" name="talla" value="{{ $talla }}" class="mr-2 hidden" @if($checkedAlready) checked @php $checkedAlready = false; @endphp @endif>
                                <label for="tallas-{{ $grupoIndex }}-{{ $tallaIndex }}" class="select-none flex items-center block border-2 border-black text-black py-2 px-4 hover:bg-black hover:text-white cursor-pointer">
                                    <span>{{ $talla }}</span>
                                </label>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div>
                <p class="text-lg font-semibold">Color</p>
                <div class="flex gap-4 flex-wrap">
                    @php $checkedAlready = true; @endphp
                    @foreach ($colores as $index => $color)
                        @if ($producto->colores && in_array($color, json_decode($producto->colores)))
                            <input type="radio" id="color-{{ $index }}" name="color" value="{{ $color }}" class="mr-2 hidden" @if($checkedAlready) checked @php $checkedAlready = false; @endif>
                            <label for="color-{{ $index }}" class="select-none flex items-center block border-2 border-black text-black py-2 px-4 hover:bg-black hover:text-white cursor-pointer">
                                <span>{{ $color }}</span>
                            </label>
                        @endif
                    @endforeach
                </div>
            </div>
            <p class="text-gray-600 text-lg">Existencia: {{ $producto->existencia }}</p>
            <div class="w-full flex flex-col md:flex-row gap-4 justify-between items-end">
                @if($producto->existencia > 0)
                    <button class="select-none w-full md:w-2/4 text-black px-4 py-2 border-2 border-black hover:bg-black hover:text-white">Agregar al carrito <b id="precio" class="font-mono" 
                        data-precio="@if ($producto->descuento)
                                {{ $producto->precio_venta - ($producto->descuento->descuento * $producto->precio_venta) }}
                            @else
                                {{ $producto->precio_venta }}
                            @endif">@if ($producto->descuento)
                                ${{ $producto->precio_venta - ($producto->descuento->descuento * $producto->precio_venta) }}
                            @else
                                ${{ $producto->precio_venta }}
                            @endif</b></button>
                @else
                    <span class="w-full md:w-2/4 text-black text-center select-none px-4 py-2 border-2 border-gray-400 cursor-not-allowed opacity-50">Agotado</span>
                @endif
                <div class="w-full md:w-auto flex flex-col gap-2">
                    <p class="text-lg font-semibold">Cantidad</p>
                    <input type="number" id="quantity" name="cantidad" class="hidden" min="1" max="{{ $producto->existencia }}" value="1" readonly>
                    <div class="flex gap-2 justify-between items-center w-full md:w-auto">
                        <div class="select-none p-2 border-black border-2 cursor-pointer" onclick="decrement()">-</div>
                        <div class="select-none border-black border-2 p-2 w-auto font-mono" id="cantidad-valor">1</div>
                        <div class="select-none p-2 border-black border-2 cursor-pointer" onclick="increment()">+</div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@if (session('success'))
    <x-notify id="notificacionAgregado" title="¡Producto agregado al carrito!">
        <p class="">{{ session('success') }}</p>
    </x-notify>
@endif
@endsection

@section('script')
<script>
    let cantidadValor = document.getElementById('cantidad-valor');
    let precio = document.getElementById('precio');
    function increment() {
        var input = document.getElementById('quantity');
        var value = parseInt(input.value, 10);
        var max = parseInt(input.getAttribute('max'), 10);
        if (value < max) {
            input.value = value + 1;
            cantidadValor.innerHTML = input.value;
            let nuevoPrecio = precio.dataset.precio * input.value;
            precio.innerText = `$${nuevoPrecio.toFixed(2)}`;
        }
    }

    function decrement() {
        var input = document.getElementById('quantity');
        var value = parseInt(input.value, 10);
        var min = parseInt(input.getAttribute('min'), 10);
        if (value > min) {
            input.value = value - 1;
            cantidadValor.innerHTML = input.value;
            let nuevoPrecio = precio.dataset.precio * input.value;
            precio.innerText = `$${nuevoPrecio.toFixed(2)}`;
        }
    }
</script>
@endsection
