@extends('layouts.app')

@section('title')
<title>Historial de pedidos | Calzado Amaya</title>
@endsection

@section('content')
<div class="p-4 md:p-8">
    <div class="w-full flex justify-between items-center">
        <h2 class="font-bold text-2xl md:text-3xl mb-6">Historial de pedidos</h2>
        <span class="p-2 bg-gray-200 rounded-lg h-fit">{{ Auth::check() ? Auth::user()->puntos->puntos ?? 0 : 0 }}</span>
    </div>

    <div class="space-y-8">
        @forelse($pedidos as $compra)
        <div class="border border-gray-200 rounded-md p-4 md:p-6">
            <div class="flex flex-col md:flex-row justify-between mb-4">
                <h3 class="text-lg md:text-xl font-semibold">Pedido #{{ $compra->compra_id }}</h3>
                <span class="text-gray-500">{{ $compra->fecha_compra }}</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-y-4 md:gap-y-0 md:gap-x-8">
                <div class="col-span-1">
                    <h4 class="text-lg font-semibold mb-2">Detalles de la compra</h4>
                    <ul class="list-disc list-inside mb-2">
                        @foreach($compra->detalle as $detalle)
                        <li>
                            <span>{{ $detalle->productos->nombre }}</span>
                            <span class="ml-2 text-gray-500">x{{ $detalle->cantidad }}</span>
                        </li>
                        @endforeach
                    </ul>
                    <p class="font-semibold">Detalles:</p>
                    <blockquote class="border-l-4 border-gray-500 pl-4 py-2">
                        <p>{{ $compra->detalles }}</p>
                    </blockquote>
                </div>
                <div class="col-span-1">
                    <h4 class="text-lg font-semibold mb-2">Información de envío</h4>
                    <p><span class="font-semibold">Nombre:</span> {{ $compra->nombres }} {{ $compra->apellidos }}</p>
                    <p><span class="font-semibold">Ubicación:</span> {{ $compra->ubicacion_envio }}</p>
                    <p><span class="font-semibold">Correo:</span> {{ $compra->correo }}</p>
                    <p><span class="font-semibold">Teléfono:</span> {{ $compra->telefono }}</p>
                    <p><span class="font-semibold">Precio Total:</span> ${{ $compra->precio_total }}</p>
                </div>
                <div class="col-span-1">
                    <h4 class="text-lg font-semibold mb-2">Información de estado</h4>
                    <p><span class="font-semibold">Estado:</span> {{ $compra->estado }}</p>
                    <p><span class="font-semibold">Fecha de entrega (estimado):</span> {{ $compra->fecha_envio }}</p>
                </div>
            </div>
        </div>
        @empty
            <p class="mt-4">No hay pedidos realizados.</p>
        @endforelse
    </div>
</div>
@endsection
