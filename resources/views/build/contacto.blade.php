@extends('layouts.app')

@section('title')
    <title>Contacto | Calzado Amaya</title>
@endsection

@section('content')
    <section class="max-w-4xl mx-auto px-4 py-8">
        <h2 class="text-3xl font-semibold mb-4">Contacto</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-xl font-semibold mb-2">Información de contacto</h3>
                <p>Si tienes alguna pregunta, comentario o sugerencia, no dudes en contactarnos. Estamos aquí para ayudarte.</p>
                <ul class="mt-4">
                    <li><strong>Instagram:</strong> <a target="_blank" href="https://www.instagram.com/calzadoamaya/">@calzadoamaya <i class="fa-brands fa-instagram"></i></a></li>
                    <li><strong>Facebook:</strong> <a target="_blank" href="https://www.facebook.com/profile.php?id=61558141000631">Calzado Amaya <i class="fa-brands fa-facebook"></i></a></li>
                    <li><strong>Correo electrónico:</strong> <a target="_blank" href="mailto:contacto@calzadoamaya.com">contacto@calzadoamaya.com <i class="fa-regular fa-envelope"></i></a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-2">Envíanos un mensaje</h3>
                <form action="#" method="POST" class="grid grid-cols-1 gap-4">
                    <div>
                        <label for="nombre" class="block mb-1">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="email" class="block mb-1">Correo electrónico</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="mensaje" class="block mb-1">Mensaje</label>
                        <textarea id="mensaje" name="mensaje" rows="4" class="w-full px-4 py-2 border rounded-md"></textarea>
                    </div>
                    <button type="submit" class="bg-main-yellow text-white px-4 py-2 rounded-md hover:bg-yellow-500 transition duration-300">Enviar mensaje</button>
                </form>
            </div>
        </div>
    </section>
@endsection
