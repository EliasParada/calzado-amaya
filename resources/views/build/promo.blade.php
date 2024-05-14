@extends('layouts.app')

@section('title')
<title>Promociones | Calzado Amaya</title>
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

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-full p-8">
    @forelse($promociones as $promocion)
    <div class="bg-white p-4 shadow-md rounded-md relative">
        <a href="{{ route('producto', $promocion->productos->producto_id) }}" class="block h-full w-full flex flex-col gap-4 justify-between relative">
            @foreach (json_decode($promocion->productos->imagenes) as $index => $imagen)
            @if($index >= 1)
            @break
            @endif
            <img src="{{ asset('imagenes/' . $imagen) }}" alt="{{ $promocion->productos->nombre }}" class="w-full h-auto">
            @endforeach
            <div class="flex flex-col gap-2">
                <h3 class="text-lg font-semibold mb-2">{{ $promocion->productos->nombre }}</h3>
                <p class="text-gray-600">{{ $promocion->productos->categoria->nombre }}</p>
                <p><span class="text-base line-through text-gray-400">${{ $promocion->productos->precio_venta }}</span> <b class="text-xl text-yellow-500 font-bold">${{ number_format($promocion->productos->precio_venta - ($promocion->descuento * $promocion->productos->precio_venta), 2) }}</b></p>
            </div>
            @if ($promocion->productos->existencia <= 0)
            <div class="border-2 border-red-500 text-red-500 font-bold text-3xl bg-white/25 p-4 absolute -rotate-45 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2">
                Agotado
            </div>
            @endif
        </a>
        <div class="text-2xl flex items-center absolute top-10 right-0 -rotate-45">
            <div class="bg-red-500 text-white px-2 py-1 rounded-full mr-2 rotate-45">
                <i class="fas fa-tag"></i>
            </div>
            <p class="text-red-500 font-bold">${{ $promocion->descuento * 100 }}%</p>
        </div>
    </div>
    @empty
    <span class="m-auto col-span-2 w-full text-center">No se han encontrado productos</span>
    @endforelse
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