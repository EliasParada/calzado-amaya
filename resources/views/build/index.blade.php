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
            <a href="" class="max-w-xs rounded-lg w-1/4 overflow-hidden shadow-md">
                <img src="{{ asset('img/categoria' . $index . '.jpg') }}" alt="Categoria$index" class="w-full">
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
    
    <a href="{{ route('categorias') }}" class="inline-block text-black bg-white px-8 py-3 border-2 border-black shadow-md hover:bg-gray-200 active:bg-black active:text-white transition duration-300">Ver más</a>

    <div class="flex flex-wrap w-full justify-evenly gap-8 mb-12">
        @foreach($categorias as $index => $categoria)
            @if($index >= 3)
                @break
            @endif
            <a href="" class="max-w-xs rounded-lg w-1/4 overflow-hidden shadow-md">
                <img src="{{ asset('img/categoria1.jpg') }}" alt="Categoria 1" class="w-full">
                <div class="p-4">
                    <p class="text-lg font-semibold mb-2">{{ $categoria->nombre }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>

<div class="text-center flex flex-col items-center gap-8 px-6 py-24">
    <p class="text-4xl font-semibold mb-4">Promociones</p>
    <p class="text-lg md:w-2/3">Ofertas especiales para ti, ahorra hasta un 25% en tus compras.</p>
    
    <a href="{{ route('categorias') }}" class="inline-block text-black bg-white px-8 py-3 border-2 border-black shadow-md hover:bg-gray-200 active:bg-black active:text-white transition duration-300">Ver más</a>

    <div class="flex flex-wrap w-full justify-evenly gap-8 mb-12">
        @foreach($categorias as $index => $categoria)
            @if($index >= 3)
                @break
            @endif
            <a href="" class="max-w-xs rounded-lg w-1/4 overflow-hidden shadow-md">
                <img src="{{ asset('img/categoria1.jpg') }}" alt="Categoria 1" class="w-full">
                <div class="p-4">
                    <p class="text-lg font-semibold mb-2">{{ $categoria->nombre }}</p>
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