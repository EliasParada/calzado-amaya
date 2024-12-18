@extends('layouts.app')

@section('title')
<title>Carrito | Calzado Amaya</title>
@endsection

@section('content')
<div class="container mx-auto p-8">
    <h2 class="text-3xl font-bold mb-4">Carrito de compras</h2>

    <div class="container mx-auto flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 pr-4">
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
                            <h3 class="">
                                <input type="number" id="quantity" name="cantidad" class="hidden" min="1" max="{{ $item['cantidad_disponible'] }}" value="{{ $item['cantidad'] }}" value="1" readonly>
                                <div class="flex gap-2 justify-start items-center">
                                    <form action="{{ route('carrito.decrementar', $item['producto_id']) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 border-black border-2 cursor-pointer">-</button>
                                    </form>
                                    <div class="border-black border-2 border-black p-2 w-8" id="cantidad-valor-{{ $item['producto_id'] }}">{{ $item['cantidad'] }}</div>
                                    <form action="{{ route('carrito.incrementar', $item['producto_id']) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 border-black border-2 cursor-pointer">+</button>
                                    </form>
                                </div>
                            </h3>
                        </div>
                        <div class="h-full flex items-end">
                            <button type="submit" class="text-black" data-bs-toggle-modal="#alertaEliminarProducto" data-form="#eliminarProductoForm{{ $item['producto_id'] }}" data-producto="{{ $item['nombre'] }}" data-boton="#boton-eliminar">Eliminar</button>
                        </div>
                    </div>

                    <form id="eliminarProductoForm{{ $item['producto_id'] }}" action="{{ route('carrito.eliminar', $item['producto_id']) }}" method="POST" class="hidden">
                        @csrf
                    </form>
                    @endforeach
                </div>
                <button type="submit" class="bg-white text-black hover:bg-black hover:text-white border-2 border-black px-4 py-2 my-2" data-bs-toggle-modal="#alertaVaciarCarrito" data-form="#vaciarCarritoForm">Vaciar Carrito</button>
            @else
            <p class="mt-4">El carrito está vacío.</p>
            @endif
        </div>
        <div class="w-full md:w-1/2 pl-4 flex items-start justify-start flex-col">
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
                    <p id="total">${{ $subtotal }}</p>
                </div>
            </ul>
            @if (count($carrito) > 0)
            <form action="{{ route('envio') }}" method="POST">
                @csrf
                <button type="submit" class="bg-white text-black px-4 py-2 border-2 border-black hover:bg-black hover:text-white mt-4 w-full">Continuar con al envio</button>
            </form>
            @else
                <a href="{{ route('categorias') }}" class="bg-white text-black px-4 py-2 border-2 border-black hover:bg-black text-center hover:text-white mt-4 w-full">Continua comprando</a>
            @endif
        </div>
    </div>
</div>

<x-modal id="alertaEliminarProducto" title="¡Eliminar del carrito!" textclasses="text-red-500">
    <p class="mb-4">¿Estás seguro de que deseas eliminar el producto "<b id="nombre-producto-eliminar"></b>"?</p>
    <button type="submit" id="boton-eliminar" class="submit-btn bg-white text-red-500 border-red-500 border-2 hover:bg-red-500 hover:text-white text-center px-4 py-2" data-form="">Eliminar producto</button>
</x-modal>

<x-modal id="alertaVaciarCarrito" title="¡Vaciar el carrito!" textclasses="text-red-500">
    <p class="mb-4">¿Estás seguro de que deseas vaciar el carrito?</p>
    <button type="submit" class="submit-btn bg-white text-red-500 border-red-500 border-2 hover:bg-red-500 hover:text-white text-center px-4 py-2" data-form="#vaciarCarritoForm">Vaciar carrito</button>
</x-modal>

<form id="vaciarCarritoForm" action="{{ route('carrito.vaciar') }}" method="POST" class="hidden">
    @csrf
</form>

@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('[data-bs-toggle-modal]');
        const closeButtons = document.querySelectorAll('.btn-close');
        const submitButtons = document.querySelectorAll('.submit-btn');

        toggleButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const targetModal = document.querySelector(button.getAttribute('data-bs-toggle-modal'));
                toggleModal(targetModal);

                if (button.dataset.boton) {
                    document.querySelector([button.dataset.boton]).dataset.form = button.dataset.form;
                }

                if (button.dataset.producto) {
                    document.querySelector('#nombre-producto-eliminar').innerHTML = button.dataset.producto;
                }
            });
        });

        submitButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                if (button.dataset.form && button.dataset.form !== '') {
                    document.querySelector([button.dataset.form]).submit();
                }
            });
        });

        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const modal = button.closest('.modal');
                toggleModal(modal);
                document.querySelector('#boton-eliminar').dataset.form = '';
            });
        });

        function toggleModal(modal) {
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
        }
    });
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

        fetch('/carrito/actualizar/cantidad', {
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
