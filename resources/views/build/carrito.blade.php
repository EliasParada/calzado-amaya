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
                            <h3 class="">Precio: ${{ $item['precio_unidad'] }}</h3>
                            <h3 class="">Cantidad:
                                <input type="number" id="quantity" name="cantidad" class="hidden" min="1" max="{{ $item['cantidad_disponible'] }}" value="{{ $item['cantidad'] }}" value="1" readonly>
                                <div class="flex gap-2 justify-start items-center">
                                    <div class="p-2 border-black border-2 cursor-pointer" onclick="decrement({{ $item['producto_id'] }})" id="decrement-btn-{{ $item['producto_id'] }}">-</div>
                                    <div class="border-black border-2 border-black p-2 w-8" id="cantidad-valor-{{ $item['producto_id'] }}">{{ $item['cantidad'] }}</div>
                                    <div class="p-2 border-black border-2 cursor-pointer" onclick="increment({{ $item['producto_id'] }})" id="increment-btn-{{ $item['producto_id'] }}">+</div>
                                </div>
                            </h3>
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
            </ul>
            <form action="{{ route('cobrar') }}" method="POST">
                @csrf
                <button type="submit" class="bg-white text-black px-4 py-2 border-2 border-black hover:bg-black hover:text-white mt-4 w-full">Continuar con la compra</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function increment(productId) {
        updateQuantity(productId, 1);
    }

    function decrement(productId) {
        updateQuantity(productId, -1);
    }

    function updateQuantity(productId, incrementBy) {
        let quantityElement = document.getElementById(`cantidad-valor-${productId}`);
        console.log(productId);
        let currentValue = parseInt(quantityElement.textContent);
        let newValue = currentValue + incrementBy;

        let incrementButton = document.getElementById(`increment-btn-${productId}`);
        let decrementButton = document.getElementById(`decrement-btn-${productId}`);
        incrementButton.disabled = true;
        decrementButton.disabled = true;

        fetch('{{ route('actualizar.cantidad') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                productId: productId,
                newValue: newValue
            })
        })
        .then(response => response.json())
        .then(data => {
            quantityElement.textContent = newValue;
            document.getElementById('subtotal').innerHTML = `$${data.subtotal}`;
            incrementButton.disabled = false;
            decrementButton.disabled = false;
        })
        .catch(error => {
            console.error('Error:', error);
            incrementButton.disabled = false;
            decrementButton.disabled = false;
        });
    }
</script>
@endsection
