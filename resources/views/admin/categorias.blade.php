@extends('layouts.app')

@section('title')
<title>Administrar Categorias | Calzado Amaya</title>
@endsection

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Administrar Categorías</h1>

    <button type="button" class="bg-white text-black border border-black hover:bg-gray-200 font-bold py-2 px-4 rounded mb-4" id="toggleCrearCategoriaModal" data-bs-toggle-modal="#crearCategoriaModal">Crear Categoría</button>

    <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre de la Categoría</th>
                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Editar</span></th>
                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Eliminar</span></th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($categorias as $categoria)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-lg font-semibold text-gray-900">{{ $categoria->nombre }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button type="button" class="text-indigo-600 hover:text-indigo-900" data-bs-toggle-modal="#editarCategoriaModal_{{ $categoria->categoria_id }}">Editar</button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button type="button" class="text-main-red hover:text-red-500" data-bs-toggle-modal="#eliminarCategoriaModal_{{ $categoria->categoria_id }}">Eliminar</button>
                    </td>
                </tr>

                <x-modal id="editarCategoriaModal_{{ $categoria->categoria_id }}" title="Editar Categoría">
                    <form action="{{ route('categorias.update', $categoria->categoria_id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nombre_editar" class="block mb-1">Nuevo nombre de la categoría</label>
                            <input type="text" name="nombre" id="nombre_editar" value="{{ $categoria->nombre }}" class="w-full rounded-md px-4 py-2 outline-none focus:ring-2 focus:ring-main-yellow">
                        </div>
                        <button type="submit" class="rounded-lg bg-main-yellow text-secondary-black border-2 border-secondary-black w-full">Guardar cambios</button>
                    </form>
                </x-modal>

                <x-modal id="eliminarCategoriaModal_{{ $categoria->categoria_id }}" title="Eliminar Categoría">
                    <p class="mb-4">¿Estás seguro de que deseas eliminar la categoría "{{ $categoria->nombre }}"?</p>
                    <form action="{{ route('categorias.destroy', $categoria->categoria_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-lg bg-main-red text-white px-4 py-2 hover:bg-red-700">Eliminar</button>
                    </form>
                </x-modal>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                        <p class="text-gray-600 mb-2">No hay categorías disponibles.</p>
                        <p class="text-gray-600 mb-2 text-5xl"><i class="fa-solid fa-rectangle-list"></i></p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<x-modal id="crearCategoriaModal" title="Crear Categoría">
    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <div class="mb-4 w-full">
            <label for="nombre" class="block mb-1">Nombre de la categoría</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre de la categoría" class="rounded-md px-4 py-2 outline-none focus:ring-2 focus:ring-main-yellow">
        </div>
        <button type="submit" class="rounded-lg bg-main-yellow text-secondary-black border-2 border-secondary-black w-full">Crear</button>
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