@extends('layouts.app')

@section('title')
<title>Administrar Promociones | Calzado Amaya</title>
@endsection

@section('content')
<div class="p-4">
    <h1 class="text-2xl font-semibold mb-4">Administrar Promociones</h1>

    <button type="button" class="bg-white text-black border border-black hover:bg-gray-200 font-bold py-2 px-4 rounded mb-4" id="toggleCrearPromocionModal" data-bs-toggle-modal="#crearPromocionModal">Crear Promoción</button>

    <div class="overflow-x-auto shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descuento</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inicio</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fin</th>
                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Editar</span></th>
                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Eliminar</span></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($promociones as $promo)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg font-semibold text-gray-900">({{ $promo->productos->codigo }}) {{ $promo->productos->nombre }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg font-semibold text-gray-900">{{ $promo->descuento * 100 }}%</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg font-semibold text-gray-900">{{ $promo->fecha_inicio }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg font-semibold text-gray-900">{{ $promo->fecha_fin }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button type="button" class="text-indigo-600 hover:text-indigo-900" data-bs-toggle-modal="#editarPromocionModal_{{ $promo->promocion_id }}">Editar</button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button type="button" class="text-main-red hover:text-red-500" data-bs-toggle-modal="#eliminarPromocionModal_{{ $promo->promocion_id }}">Eliminar</button>
                        </td>
                    </tr>

                    <x-modal id="editarPromocionModal_{{ $promo->promocion_id }}" title="Editar Categoría" textclasses="">
                        <form action="{{ route('promo.update', $promo->promocion_id) }}" method="POST">
                            @csrf
                            <div class="mb-4 w-full">
                                <label for="codigo" class="block text-sm font-medium text-gray-700">Nuevo código del producto:</label>
                                <select name="producto_id" id="codigo" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" required>
                                    @forelse ($productos as $producto)
                                        <option value="{{ $producto->producto_id }}" @if ($producto->producto_id == $promo->producto_id) checked @endif>{{ $producto->codigo }}</option>
                                    @empty
                                        <option value="">No hay productos</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="descuento" class="block text-sm font-medium text-gray-700">Nuevo descuento (1 = 100%, 0 = 0%):</label>
                                <input value="{{ $promo->descuento }}" type="number" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="descuento" name="descuento" step="0.01" min="0.00" max="1.00" required>
                            </div>
                            <div class="mb-4">
                                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Nueva fecha de inicio de la promoción:</label>
                                <input value="{{ $promo->fecha_inicio }}" type="date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="fecha_inicio" name="fecha_inicio" required>
                            </div>
                            <div class="mb-4">
                                <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Nueva fecha de finalización de la promoción:</label>
                                <input  value="{{ $promo->fecha_fin }}"type="date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="fecha_fin" name="fecha_fin" required>
                            </div>
                            <button type="submit" class="px-4 py-2 text-black border-2 border-black hover:bg-black hover:text-white">Guardar cambios</button>
                        </form>
                    </x-modal>

                    <x-modal id="eliminarPromocionModal_{{ $promo->promocion_id }}" title="Eliminar Categoría" textclasses="">
                        <p class="mb-4">¿Estás seguro de eliminar la promoción de "{{ $promo->productos->nombre }}" a {{ $promo->descuento * 100 }}% de descuento?</p>
                        <form action="{{ route('promo.destroy', $promo->promocion_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-lg bg-main-red text-white px-4 py-2 hover:bg-red-700">Eliminar</button>
                        </form>
                    </x-modal>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                            <p class="text-gray-600 mb-2">No hay promociones disponibles.</p>
                            <p class="text-gray-600 mb-2 text-5xl"><i class="fa-solid fa-rectangle-list"></i></p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<x-modal id="crearPromocionModal" title="Crear Promoción" textclasses="">
    <form action="{{ route('promo.store') }}" method="POST">
        @csrf
        <div class="mb-4 w-full">
            <label for="codigo" class="block text-sm font-medium text-gray-700">Código del producto:</label>
            <select name="producto_id" id="codigo" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" required>
                @forelse ($productos as $producto)
                    <option value="{{ $producto->producto_id }}">{{ $producto->codigo }}</option>
                @empty
                    <option value="">No hay productos</option>
                @endforelse
            </select>
        </div>
        <div class="mb-4">
            <label for="descuento" class="block text-sm font-medium text-gray-700">Descuento (1 = 100%, 0 = 0%):</label>
            <input type="number" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="descuento" name="descuento" step="0.01" min="0.00" max="1.00" required>
        </div>
        <div class="mb-4">
            <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha de inicio de la promoción:</label>
            <input type="date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="fecha_inicio" name="fecha_inicio" required>
        </div>
        <div class="mb-4">
            <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha de finalización de la promoción:</label>
            <input type="date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="fecha_fin" name="fecha_fin" required>
        </div>
        <button type="submit" class="px-4 py-2 text-black border-2 border-black hover:bg-black hover:text-white">Agregar categoría</button>
    </form>
</x-modal>
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