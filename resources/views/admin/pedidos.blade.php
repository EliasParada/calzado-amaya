@extends('layouts.app')

@section('title')
    <title>Administrar Pedidos | Calzado Amaya</title>
@endsection

@section('content')
    <div class="p-4">
        <h1 class="text-2xl font-semibold mb-4">Administrar Pedidos</h1>

        <div class="overflow-x-auto shadow-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pedido</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detalles</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contacto</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">Editar</span></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pedidos as $pedido)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg font-semibold text-gray-900">{{ $pedido->compra_id }}</div>
                            </td>
                            <td class="px-6 py-4 text-wrap">
                                <div class="text-lg text-gray-900">

                                    <p><span class="font-semibold truncate" title="{{ $pedido->factura_nombre }}">Factura:</span> {{ $pedido->factura_nombre }}</p>
                                    <p><span class="font-semibold truncate" title="{{ $pedido->metodo }}">Método:</span> {{ $pedido->metodo }}</p>
                                    
                                    <ul class="list-disc list-inside mb-2">
                                        @foreach($pedido->detalle as $detalle)
                                        <li>
                                            <span>{{ $detalle->productos->nombre }}</span>
                                            <span class="ml-2 text-gray-500">x{{ $detalle->cantidad }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <p class="font-semibold">Detalles:</p>
                                    <blockquote class="border-l-4 border-gray-500 pl-4 py-2 bg-gray-100 rounded-r-lg">
                                        <p>"{{ $pedido->detalles }}"</p>
                                    </blockquote>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-wrap">
                                <div class="text-lg text-gray-900">
                                    <p><span class="font-semibold">Nombre:</span> {{ $pedido->nombres }} {{ $pedido->apellidos }}</p>
                                    <p><span class="font-semibold">Ubicación:</span> {{ $pedido->ubicacion_envio }}</p>
                                    <p><span class="font-semibold">Correo:</span> {{ $pedido->correo }}</p>
                                    <p><span class="font-semibold">Teléfono:</span> {{ $pedido->telefono }}</p>
                                    <p><span class="font-semibold">Precio Total:</span> ${{ $pedido->precio_total }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-wrap">
                                <p><span class="font-semibold">Estado:</span> {{ $pedido->estado }}</p>
                                <p><span class="font-semibold">Fecha de pago:</span> {{ $pedido->fecha_compra }}</p>
                                <p><span class="font-semibold">Fecha de retiro:</span> {{ $pedido->fecha_retiro }}</p>
                                <p><span class="font-semibold">Fecha de entrega (estimado):</span> {{ $pedido->fecha_envio }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button type="button" class="text-indigo-600 hover:text-indigo-900" data-bs-toggle-modal="#editarPedidoModal_{{ $pedido->compra_id }}">Editar</button>
                            </td>
                        </tr>

                        <x-modal id="editarPedidoModal_{{ $pedido->compra_id }}" title="Editar Pedido - Factura: {{ $pedido->factura_nombre }}" textclasses="">
                            <div class="mb-4">
                                <p><span class="font-semibold">Método:</span> {{ $pedido->metodo }}</p>
                                <p><span class="font-semibold">Fecha de Compra:</span> {{ $pedido->fecha_compra }}</p>
                                <p><span class="font-semibold">Estado Actual:</span> {{ $pedido->estado }}</p>
                                <p><span class="font-semibold">Cliente:</span> {{ $pedido->nombres }} {{ $pedido->apellidos }}</p>
                                <p><span class="font-semibold">Ubicación de Envío:</span> {{ $pedido->ubicacion_envio }}</p>
                                <p><span class="font-semibold">Correo Electrónico:</span> {{ $pedido->correo }}</p>
                                <p><span class="font-semibold">Teléfono:</span> {{ $pedido->telefono }}</p>
                                <p><span class="font-semibold">Precio Total:</span> ${{ $pedido->precio_total }}</p>
                            </div>
                            <div class="mb-4">
                                <p class="font-semibold">Productos:</p>
                                <ul>
                                    @foreach($pedido->detalle as $detalle)
                                        <li>{{ $detalle->cantidad }} x {{ $detalle->productos->nombre }} ({{ $detalle->productos->codigo }})</li>
                                    @endforeach
                                </ul>
                            </div>
                            <form action="{{ route('pedidos.update', $pedido->compra_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label for="estado" class="block text-sm font-medium text-gray-700">Estado:</label>
                                    <select name="estado" id="estado" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50">
                                        <option value="PENDIENTE" {{ $pedido->estado === 'PENDIENTE' ? 'selected' : '' }}>PENDIENTE</option>
                                        <option value="COMPLETADO" {{ $pedido->estado === 'COMPLETADO' ? 'selected' : '' }}>COMPLETADO</option>
                                        <option value="ENVIADO" {{ $pedido->estado === 'ENVIADO' ? 'selected' : '' }}>ENVIADO</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="fecha_retiro" class="block text-sm font-medium text-gray-700">Fecha de Retiro:</label>
                                    <input value="{{ $pedido->fecha_retiro }}" type="date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="fecha_retiro" name="fecha_retiro">
                                </div>
                                <div class="mb-4">
                                    <label for="fecha_envio" class="block text-sm font-medium text-gray-700">Fecha de Envío:</label>
                                    <input value="{{ $pedido->fecha_envio }}" type="date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="fecha_envio" name="fecha_envio">
                                </div>
                                <button type="submit" class="px-4 py-2 text-black border-2 border-black hover:bg-black hover:text-white">Guardar cambios</button>
                            </form>
                        </x-modal>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                <p class="text-gray-600 mb-2">No hay pedidos disponibles.</p>
                                <p class="text-gray-600 mb-2 text-5xl"><i class="fa-solid fa-rectangle-list"></i></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('[data-bs-toggle-modal]');
            const closeButtons = document.querySelectorAll('.btn-close');

            toggleButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const targetModal = document.querySelector(button.getAttribute('data-bs-toggle-modal'));
                    toggleModal(targetModal);
                });
            });

            closeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const modal = button.closest('.modal');
                    toggleModal(modal);
                });
            });

            function toggleModal(modal) {
                modal.classList.toggle('opacity-0');
                modal.classList.toggle('pointer-events-none');
            }
        });
    </script>
@endsection