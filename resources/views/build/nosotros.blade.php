@extends('layouts.app')

@section('title')
    <title>Sobre Nosotros | Calzado Amaya</title>
@endsection

@section('content')
    <section class="max-w-4xl mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold mb-4">Sobre Nosotros</h2>
        <img src="{{ asset('img/calzado-amaya-color.svg') }}" alt="Calzado Amaya" class="mx-auto w-40 h-auto m-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-xl font-semibold mb-2">Sobre Calzado Amaya</h3>
                <p>En Calzado Amaya, nos dedicamos a ofrecerte la mejor selección de calzado que combina estilo, comodidad y calidad. Desde elegantes zapatos formales hasta zapatillas deportivas de última moda, nuestra amplia gama de productos garantiza que encuentres el par perfecto para cada ocasión.</p>

                <p>Con décadas de experiencia en la industria del calzado, nos enorgullecemos de brindar a nuestros clientes un servicio excepcional y una experiencia de compra sin igual. Nuestro compromiso con la excelencia se refleja en cada detalle, desde la cuidadosa selección de materiales hasta el diseño meticuloso de cada zapato.</p>

                <p>En Calzado Amaya, no solo nos preocupamos por cómo te ves, sino también por cómo te sientes. Por eso, nos esforzamos por ofrecerte no solo productos de moda, sino también calzado que se adapte a tu estilo de vida y te mantenga cómodo durante todo el día.</p>

                <p>Únete a nosotros en nuestro viaje para redefinir la moda del calzado. Descubre la calidad, el estilo y la comodidad que solo Calzado Amaya puede ofrecerte. ¡Bienvenido a nuestra familia de amantes del calzado!</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-2">Nuestra Misión</h3>
                <p>Nuestra misión es proporcionar calzado de alta calidad que combine estilo, comodidad y durabilidad. Nos esforzamos por superar las expectativas de nuestros clientes y contribuir al bienestar y la satisfacción de quienes eligen nuestros productos.</p>
            </div>
        </div>
    </section>
@endsection

<!-- <div class="flex justify-end items-center p-4 gap-2">
        <span>Puntos disponibles</span>
        <span class="p-2 bg-gray-200 rounded-lg">720</span>
    </div>
        <div class="flex gap-4 justify-between items-center">
        <span>Canjear puntos por descuento (Maximo 15%)</span>
       <input type="number" class="w-1/4 px-3 py-2 border-2 border-black focus:outline-none focus:ring focus:ring-main-yellow">     
        </div>
    <button type="submit" class="bg-white text-black px-4 py-2 border-2 border-black hover:bg-black hover:text-white mt-4 w-1/3 mr-2/3" style="
    margin-left: 33rem;
    width: 11rem;
">Canjear</button>

    <ul class="p-4 list-disc">
        <li>
        Canjeos disponibles a partir de los 700 puntos</li>
        <li>
        EL limite de canjeo es el 15%</li>
        <li>
        Por tus compras a partir de $20 hasta $25 acumula el 1% de tu compra en puntos</li>
        <li>
        Por tus compras a partir de $26 acumula el 2% de tu compra en puntos</li>
        </ul>
     -->