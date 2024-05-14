@extends('layouts.app')

@section('title')
<title>Calzado Amaya</title>
@endsection

@section('content')
<div class="slider-container h-40 md:h-80 bg-gray-200 relative">
    <div class="slider mx-auto w-full h-full overflow-hidden relative">
        <div class="slide absolute transition-all duration-300 w-full h-full flex justify-center items-center" style="background-color: #ffbd59;">
            <img src="{{ asset('imagenes/banners/banner_01.png') }}" alt="Promoción 1" class="w-auto h-full">
        </div>
        <div class="slide absolute transition-all duration-300 w-full h-full flex justify-center items-center" style="background-color: #613b24;">
            <img src="{{ asset('imagenes/banners/banner_02.png') }}" alt="Promoción 2" class="w-auto h-full">
        </div>
        <div class="slide absolute transition-all duration-300 w-full h-full flex justify-center items-center" style="background-color: #354a42;">
            <img src="{{ asset('imagenes/banners/banner_03.png') }}" alt="Promoción 3" class="w-auto h-full">
        </div>
    </div>
    <div class="prev absolute top-1/2 left-0 transform -translate-y-1/2 py-2 px-4 text-white bg-secondary-white/25 rounded-full cursor-pointer hover:bg-secondary-white/50"><</div>
    <div class="next absolute top-1/2 right-0 transform -translate-y-1/2 py-2 px-4 text-white bg-secondary-white/25 rounded-full cursor-pointer hover:bg-secondary-white/50">></div>
</div>

<div class="text-center flex flex-col items-center gap-8 px-6 py-24">
    <p class="text-4xl font-semibold mb-4">Categorías</p>
    <p class="text-lg text-gray-600 md:w-2/3">Zapatos artesanales para lucir en tu día a día como estudiante, profesional o artista, en tu grupo de amigos o en tu trabajo.</p>
    
    <a href="{{ route('categorias') }}" class="inline-block text-black bg-white px-8 py-3 border-2 border-black shadow-md hover:bg-gray-200 active:bg-black active:text-white transition duration-300">Ver más</a>

    <div class="flex flex-wrap w-full justify-evenly gap-8 mb-12">
        @foreach($categorias as $index => $categoria)
            @if($index >= 3)
                @break
            @endif
            <a href="/categorias?categorias%5B%5D={{ $categoria->categoria_id }}" class="max-w-xs rounded-lg w-1/4 overflow-hidden shadow-md">
                <img src="{{ asset('imagenes/' . json_decode($categoria->productos[0]->imagenes)[0]) }}" alt="Categoria$index" class="w-full">
                <div class="p-4">
                    <p class="text-lg font-semibold mb-2">{{ $categoria->nombre }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>


<div class="bg-gray-100 text-center flex flex-col items-center gap-8 px-6 py-24">
    <p class="text-4xl font-semibold mb-4">Productos Destacados</p>
        <p class="text-lg text-gray-600 md:w-2/3">Echa un vistazo a nuestros productos mas solicitados, viste a la moda con las tendecias de los demas.</p>
    
    <a href="{{ route('categorias') }}?ordenar=popular" class="inline-block text-black bg-white px-8 py-3 border-2 border-black shadow-md hover:bg-gray-200 active:bg-black active:text-white transition duration-300">Ver más</a>

    <div class="flex flex-wrap w-full justify-evenly gap-8 mb-12">
        @foreach($productosMasVendidos as $index => $producto)
            <a href="{{ route('producto', $producto->producto_id) }}" class="max-w-xs rounded-lg w-1/4 overflow-hidden shadow-md relative">
                <img src="{{ asset('imagenes/' . json_decode($producto->imagenes)[0]) }}" alt="{{ $producto->nombre }}" class="w-full">
                <div class="p-4">
                    <p class="text-lg font-semibold mb-2">{{ $producto->nombre }}</p>
                </div>
                @if ($producto->existencia <= 0)
                    <div class="border-2 border-red-500 text-red-500 font-bold text-3xl bg-white/25 p-4 absolute -rotate-45 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2">
                        Agotado
                    </div>
                @endif
            </a>
        @endforeach
    </div>
</div>

<div class="text-center flex flex-col items-center gap-8 px-6 py-24">
    <p class="text-4xl font-semibold mb-4">Promociones</p>
    <p class="text-lg md:w-2/3">Ofertas especiales para ti, ahorra hasta un 25% en tus compras.</p>
    
    <a href="{{ route('promo') }}" class="inline-block text-black bg-white px-8 py-3 border-2 border-black shadow-md hover:bg-gray-200 active:bg-black active:text-white transition duration-300">Ver más</a>

    <div class="flex flex-wrap w-full justify-evenly gap-8 mb-12">
        @foreach($promociones as $index => $promocion)
            <a href="{{ route('producto', $promocion->productos->producto_id) }}" class="max-w-xs rounded-lg w-1/4 overflow-hidden shadow-md relative">
                <img src="{{ asset('imagenes/' . json_decode($promocion->productos->imagenes)[0]) }}" alt="{{ $promocion->productos->nombre }}" class="w-full">
                <div class="p-4">
                    <p class="text-lg font-semibold mb-2">{{ $promocion->productos->categoria->nombre }}</p>
                    <div class="flex flex-col">
                        <h2 class="text-3xl font-bold">{{ $promocion->productos->nombre }}</h2>
                        @if ($promocion->descuento)
                            <p><span class="text-base line-through text-gray-400">${{ $promocion->productos->precio_venta }}</span> <b class="text-xl text-yellow-500 font-bold">${{ $promocion->productos->precio_venta - ($promocion->descuento * $promocion->productos->precio_venta) }}</b></p>
                        @else
                            <p class="text-gray-600">${{ $promocion->productos->precio_venta }}</p>
                        @endif
                    </div>
                </div>
                <div class="text-2xl flex items-center absolute top-10 right-0 -rotate-45">
                    <div class="bg-red-500 text-white px-2 py-1 rounded-full mr-2 rotate-45">
                        <i class="fas fa-tag"></i>
                    </div>
                    <p class="text-red-500 font-bold">${{ $promocion->descuento * 100 }}%</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection

@section('script')
<script>
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    let currentIndex = 0;
    let isAnimating = false;

    function showSlide(index) {
        if (isAnimating) return;

        isAnimating = true;

        const direction = index > currentIndex ? 1 : -1;

        slides.forEach((slide, i) => {
            if (i === index) {
                slide.style.transform = 'translateX(0)';
            } else if (i === currentIndex) {
                slide.style.transform = `translateX(${direction * 100}%)`;
            }
        });

        currentIndex = index;

        setTimeout(() => {
            isAnimating = false;
        }, 500);
    }

    function nextSlide() {
        const nextIndex = (currentIndex + 1) % slides.length;
        showSlide(nextIndex);
    }

    function prevSlide() {
        const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
        showSlide(prevIndex);
    }

    document.querySelector('.next').addEventListener('click', nextSlide);
    document.querySelector('.prev').addEventListener('click', prevSlide);

    setInterval(nextSlide, 5000);

    showSlide(currentIndex);
</script>
@endsection