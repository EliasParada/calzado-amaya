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
$colores = ['Rojo', 'Azul', 'Blanco', 'Café', 'Morado', 'Beige', 'Gris', 'Rosado', 'Anaranjado', 'Ocre','Negro'];

$tallas = [
    [24,25,26,27,28,29,30,31,32],
    [35,36,37,38,39,40,41,42,43]
];
@endphp
    <div class="flex justify-center mt-8 w-full">
        <form action="{{ route('carrito.store') }}" method="POST" class="w-full px-4 flex gap-4">
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
                    <div class="flex gap-4 flex-wrap">
                        @php $checkedAlready = true; @endphp
                        @foreach ($tallas as $grupoIndex => $grupo)
                            @foreach ($grupo as $tallaIndex => $talla)
                                @if ($producto->tallas && in_array($talla, json_decode($producto->tallas)))
                                    <input type="radio" id="tallas-{{ $grupoIndex }}-{{ $tallaIndex }}" name="talla" value="{{ $talla }}" class="mr-2 hidden" @if($checkedAlready) checked @php $checkedAlready = false; @endphp @endif>
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
                    <div class="flex gap-4 flex-wrap">
                        @php $checkedAlready = true; @endphp
                        @foreach ($colores as $index => $color)
                            @if ($producto->colores && in_array($color, json_decode($producto->colores)))
                                <input type="radio" id="color-{{ $index }}" name="color" value="{{ $color }}" class="mr-2 hidden" @if($checkedAlready) checked @php $checkedAlready = false; @endif>
                                <label for="color-{{ $index }}" class="flex items-center block border-2 border-black text-black py-2 px-4 hover:bg-black hover:text-white cursor-pointer">
                                    <span>{{ $color }}</span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>
                <p class="text-gray-600">Existencia: {{ $producto->existencia }}</p>
                <div class="w-full flex gap-4 justify-between items-end">
                    @if($producto->existencia > 0)
                        <button class="w-2/4 text-bacl px-4 py-2 border-2 border-black hover:bg-black hover:text-white text-nowrap w-auto">Agregar al carrito <b id="precio" class="font-mono" data-precio="{{ $producto->precio_venta }}">${{ $producto->precio_venta }}</b></button>
                    @else
                        <button class="w-2/4 text-bacl px-4 py-2 border-2 border-gray-400 cursor-not-allowed opacity-50">Agotado</button>
                    @endif
                    <div class="w-1/4 flex flex-col gap-2">
                        <p>Cantidad</p>
                        <input type="number" id="quantity" name="cantidad" class="hidden" min="1" max="{{ $producto->existencia }}" value="1" readonly>
                        <div class="flex gap-2 justify-between items-center w-auto">
                            <div class="p-2 border-black border-2 cursor-pointer" onclick="decrement()">-</div>
                            <div class="border-black border-2 border-black p-2 w-auto font-mono" id="cantidad-valor">1</div>
                            <div class="p-2 border-black border-2 cursor-pointer" onclick="increment()">+</div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div>
        Producto agregado
    </div>

    <x-notify id="notificacionAgregado" title="¡Producto agregado al carrito!">
        <p class="mb-4">{{ session('success') }}</p>
    </x-notify>
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
            precio.innerText = `$${nuevoPrecio}`;
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
            precio.innerText = `$${nuevoPrecio}`;
        }
    }
</script>
@endsection
