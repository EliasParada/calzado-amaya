@extends('layouts.app')

@section('title')
    <title>Catalogo | {{ config('app.name') }}</title>
@endsection

@section('content')
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

        <div class="w-3/4 px-4">
            <h2 class="text-lg font-semibold mb-4">Productos</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($productos as $producto)
                    <div class="bg-white p-4 shadow-md rounded-md">
                        <h3 class="text-lg font-semibold mb-2">{{ $producto->nombre }}</h3>
                        <p class="text-gray-600">{{ $producto->categoria->nombre }}</p>
                        <p class="text-gray-600">${{ $producto->precio_venta }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $productos->links() }}
            </div>
        </div>
    </div>
@endsection