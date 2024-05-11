@extends('layouts.app')

@section('title')
<title>Catálogo | {{ config('app.name') }}</title>
@endsection

@section('content')
<h2 class="text-3xl font-semibold mb-4 self-start m-8">Catálogo</h2>
<div class="md:flex justify-center mt-8">

    <div class="w-full md:w-1/4 px-4">
        <div class="flex w-full gap-4 items-center mb-4">
            <h2 class="text-lg font-semibold">Filtros</h2>
            <a href="{{ route('categorias') }}" class="text-gray-400 underline text-sm">Limpiar filtros</a>
        </div>
        <form action="{{ route('categorias') }}" method="GET" class="h-0 md:h-auto overflow-hidden">
            <input type="hidden" name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">
            <h3 class="text-md font-semibold mb-2">Categorías</h3>
            @foreach($categorias as $categoria)
            <label class="block mb-2">
                <input type="checkbox" name="categorias[]" value="{{ $categoria->categoria_id }}" {{ in_array($categoria->categoria_id, request('categorias', [])) ? 'checked' : '' }}>
                <span class="ml-2">{{ $categoria->nombre }}</span>
            </label>
            @endforeach
            <button type="submit" class="bg-white hover:bg-black text-black hover:text-white border-2 border-black px-4 py-2 mt-2">Aplicar filtros</button>
        </form>
    </div>

    <div class="w-full md:w-3/4 px-4 flex flex-col items-end">
        <div class="border-2 border-black flex gap-2 w-fit py-2 px-8 cursor-pointer">
            <p class="text-slate-400 w-auto">Ordenar por </p>
            <select id="ordenar" class="text-black">
                <option value="popular">Popular</option>
                <option value="nombre">Nombre</option>
                <option value="precio">Precio</option>
            </select>
        </div>
        <p>Mostrando {{ $productos->count() }} productos</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-full">
            @forelse($productos as $producto)
            <div class="bg-white p-4 shadow-md rounded-md relative">
                <a href="{{ route('producto', $producto->producto_id) }}" class="block h-full w-full flex flex-col gap-4 justify-between relative">
                    @foreach (json_decode($producto->imagenes) as $index => $imagen)
                    @if($index >= 1)
                    @break
                    @endif
                    <img src="{{ asset('imagenes/' . $imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-auto">
                    @endforeach
                    <div class="flex flex-col gap-2">
                        <h3 class="text-lg font-semibold mb-2">{{ $producto->nombre }}</h3>
                        <p class="text-gray-600">{{ $producto->categoria->nombre }}</p>
                        <p class="text-gray-600">${{ $producto->precio_venta }}</p>
                    </div>
                    @if ($producto->existencia <= 0)
                    <div class="border-2 border-red-500 text-red-500 font-bold text-3xl bg-white/25 p-4 absolute -rotate-45 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2">
                        Agotado
                    </div>
                    @endif
                </a>
            </div>
            @empty
            <span class="m-auto col-span-2 w-full text-center">No se han encontrado productos @if ($_GET['search']) de la busqueda <b>"{{ $_GET['search'] }}"</b> @endif</span>
            @endforelse
        </div>

        <div class="p-4 ">
            <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
                @if ($productos->onFirstPage())
                <span aria-disabled="true" aria-label="&amp;laquo; Previous">
                    <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5" aria-hidden="true">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>
                @else
                <a href="{{ $productos->appends(['search' => request('search'), 'categorias' => request('categorias'), 'ordenar' => request('ordenar')])->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </a>
                @endif

                @for ($i = 1; $i <= $productos->lastPage(); $i++)
                    @if ($i == $productos->currentPage())
                    <span aria-current="page">
                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">{{ $i }}</span>
                    </span>
                    @else
                        <a href="{{ $productos->appends(['search' => request('search'), 'categorias' => request('categorias'), 'ordenar' => request('ordenar')])->url($i) }}"class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="Ir a la página {{ $i }}">{{ $i }}</a>
                    @endif
                @endfor

                @if ($productos->hasMorePages())
                <a href="{{ $productos->appends(['search' => request('search'), 'categorias' => request('categorias'), 'ordenar' => request('ordenar')])->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Next &raquo;">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </a>
                @else
                <span aria-disabled="true" aria-label="Next &amp;raquo;">
                    <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5" aria-hidden="true">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </span>
                @endif
            </span>
        </div>

    </div>
</div>

@endsection

@section('script')
<script>
    document.getElementById('ordenar').addEventListener('change', function() {
        var orden = this.value;
        var url = new URL(window.location.href);
        url.searchParams.set('ordenar', orden);
        window.location.href = url;
    });
</script>
@endsection