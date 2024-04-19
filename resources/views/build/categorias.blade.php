@extends('layouts.app')

@section('title')
    <title>Catalogo | {{ config('app.name') }}</title>
@endsection

@section('content')
    <h2 class="text-3xl font-semibold mb-4 self-start m-8">Catalogo</h2>
    <div class="flex justify-center mt-8">

        <div class="w-1/4 px-4">
            <h2 class="text-lg font-semibold mb-4">Filtros</h2>
            <div class="mb-4">
                <h3 class="text-md font-semibold mb-2">Categorías</h3>
                @foreach($categorias as $categoria)
                    <label class="block mb-2">

                        <input type="checkbox" name="categorias[]" value="{{ $categoria->id }}">
                        <span class="ml-2">{{ $categoria->nombre }}</span>
                    </label>
                @endforeach
            </div>
            <div class="mb-4">
                <h3 class="text-md font-semibold mb-2">Precio</h3>
                <input type="range" min="0" max="100" value="50" class="w-full">
            </div>
        </div>

        <div class="w-3/4 px-4 flex flex-col items-end">
            <div class="border-2 border-black flex gap-2 w-fit py-2 px-8">
                <p class="text-slate-400 w-auto">Ordenar por </p><b>Popular</b>
            </div>
            <p>Mostrando 10 productos</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($productos as $producto)
                    <div class="bg-white p-4 shadow-md rounded-md">
                        <a href="{{ route('producto', $producto->producto_id) }}"">
                            @foreach (json_decode($producto->imagenes) as $index => $imagen)
                                @if($index >= 1)
                                    @break
                                @endif
                                <img src="{{ asset('imagenes/' . $imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-auto">
                            @endforeach
                            <h3 class="text-lg font-semibold mb-2">{{ $producto->nombre }}</h3>
                            <p class="text-gray-600">{{ $producto->categoria->nombre }}</p>
                            <p class="text-gray-600">${{ $producto->precio_venta }}</p>
                        </a>
                        <!-- <button class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2" onclick="openCartModal('{{ $producto }}')">Agregar al carrito</button> -->
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $productos->links() }}
            </div>
        </div>
    </div>

    <div id="cartModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-md w-1/4">
            <h2 class="text-lg font-semibold mb-4" id="productName"></h2>
            <p id="productDescription" class="text-gray-600 mb-2"></p>
            <p id="productPrice" class="text-gray-600 mb-4"></p>
            <label for="quantity" class="block mb-2">Cantidad</label>
            <input type="number" id="quantity" class="w-full border-gray-300 rounded-md px-3 py-2" min="1" max="{{ $producto->existencia }}">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4" onclick="addToCart()">Agregar al carrito</button>
            <button class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md mt-2" onclick="closeCartModal()">Cancelar</button>
        </div>
    </div>
@endsection

@section('script')
<script>
        function openCartModal(product) {
            var productInfo = JSON.parse(product);
            document.getElementById('productName').textContent = productInfo.nombre;
            document.getElementById('productDescription').textContent = productInfo.descripcion;
            document.getElementById('productPrice').textContent = '$' + productInfo.precio_venta;
            document.getElementById('quantity').setAttribute('max', productInfo.existencia);
            document.getElementById('cartModal').classList.remove('hidden');
        }

        function closeCartModal() {
            document.getElementById('cartModal').classList.add('hidden');
        }

        function addToCart() {
            // Aquí puedes agregar la lógica para agregar el producto al carrito
            // Puedes enviar la cantidad y el ID del producto a través de una solicitud AJAX o cualquier otro método
            // En este ejemplo, simplemente cerramos el modal
            closeCartModal();
        }
    </script>
@endsection
