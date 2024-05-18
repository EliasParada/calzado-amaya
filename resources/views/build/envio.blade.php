@extends('layouts.app')

@section('title')
<title>Envio | Calzado Amaya</title>
@endsection

@section('content')
<div class="container mx-auto p-8">
    <h2 class="text-3xl font-bold mb-4">Enformación de envio</h2>

    <div class="container mx-auto flex flex-col md:flex-row justify-around">
        <form action="{{ route('cobrar') }}" method="POST" class="w-full md:w-1/2 pl-4 flex items-start justify-start flex-col">
            @csrf
            <input type="hidden" id="envio" name="envio" required class="hidden" value="{{ $envio }}">
            <input type="hidden" id="nombre" name="nombre" required class="hidden" value="{{$contacto['nombre']}}">
            <input type="hidden" id="apellido" name="apellido" required class="hidden" value="{{$contacto['apellido']}}">
            <input type="hidden" id="telefono" name="telefono" required class="hidden" value="{{$contacto['telefono']}}">
            <input type="hidden" id="correo" name="correo" required class="hidden" value="{{$contacto['correo']}}">
            <input type="hidden" id="direccion" name="direccion" required class="hidden" value="{{$contacto['direccion']}}">
            <textarea id="detalle" name="detalle" class="hidden">{{$contacto['detalle']}}</textarea>

            <h2 class="text-xl font-bold mb-4">Resumen del pedido</h2>
            <div class="w-full flex flex-col gap-2">
                <div class="mb-4 border-2 border-black flex gap-4 items-center">
                    <div class="w-14 h-14 m-2">
                        <img src="{{ asset('img/cargo-expreso.png') }}" alt="Cargo Expreso" srcset="">
                    </div>
                    <div>
                        <label for="telefono" class="block mb-1">Cargo Express</label>
                        <label for="telefono" class="block mb-1 font-bold">${{ $envio }}</label>
                    </div>
                </div>
                <button type="submit" class="bg-white text-black px-4 py-2 border-2 border-black hover:bg-black hover:text-white mt-4 w-full">Continuar al pago</button>
            </div>
        </form>
        <div class="w-full md:w-1/3 p-4">
            @if(count($carrito) > 0)
                <div class="overflow-x-auto w-full">
                    @foreach($carrito as $item)
                    <div class="flex gap-4 justify-start w-full">
                        <a href="{{ route('producto', $item['producto_id']) }}" class="flex items-center justify-center w-1/3 relative">
                            @foreach (json_decode($item['imagenes']) as $index => $imagen)
                                @if($index >= 1)
                                    @break
                                @endif
                                <img src="{{ asset('imagenes/' . $imagen) }}" alt="{{ $item['nombre'] }}" class="w-28 h-auto mr-2">
                            @endforeach
                            <div class="absolute bg-gray-400 text-white font-bold rounded-lg p-2 top-0 right-0">
                                {{ $item['cantidad'] }}
                            </div>
                        </a>
                        <div class="flex flex-col w-full">
                            <h3 class="text-xl font-bold">{{ $item['nombre'] }}</h3>
                            <h3 class="">Talla: {{ $item['talla'] }}</h3>
                            <h3 class="">Color: {{ $item['color'] }}</h3>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">${{ $item['precio_unidad'] * $item['cantidad'] }}</h3>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="mt-4">El carrito está vacío.</p>
            @endif
            <div class="w-full flex flex-col gap-2">
                <div class="mb-2 w-full flex justify-between">
                    <p>Subtotal:</p>
                    <p id="subtotal">${{ $subtotal }}</p>
                </div>
                <div class="mb-2 w-full flex justify-between">
                    <p>Envio:</p>
                    <p id="envio">${{ $envio }}</p>
                </div>
                <div class="border-t border-gray-300 py-2 font-semibold w-full flex justify-between">
                    <p>Total a pagar:</p>
                    <p id="total">{{ $subtotal }}</p>
                </div>
            </div>

            <div class="flex justify-end items-center p-4 gap-2">
                <span>Puntos disponibles</span>
                <span class="p-2 bg-gray-200 rounded-lg">{{ Auth::check() ? Auth::user()->puntos->puntos ?? 0 : 0 }}</span>
            </div>
            <div class="flex gap-4 justify-between items-center">
                <span>Canjear puntos por descuento (Maximo 15%)</span>
                <input type="number" class="w-1/4 px-3 py-2 border-2 border-black focus:outline-none focus:ring focus:ring-main-yellow" min="700" step="10" max="{{ ($subtotal * 0.15) * 100 }}" @if ((Auth::check() ? Auth::user()->puntos->puntos ?? 0 : 0) < 700) disabled placeholder="No disponible" title="No disponible" @endif >     
            </div>
            <div class="w-full flex justify-end">
                <button type="submit" class="bg-white text-black px-4 py-2 border-2 border-black hover:bg-black hover:text-white mt-4 w-1/3 mr-2/3" style="margin-left: 33rem; width: 11rem;">Canjear</button>
            </div>

            <ul class="p-4 list-disc">
                <li>Canjeos disponibles a partir de los 700 puntos</li>
                <li>EL limite de canjeo es el 15%</li>
                <li>Por tus compras a partir de $20 hasta $25 acumula el 1% de tu compra en puntos</li>
                <li>Por tus compras a partir de $26 acumula el 2% de tu compra en puntos</li>
            </ul>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>

</script>
@endsection
