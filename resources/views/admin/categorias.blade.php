@extends('layouts.app')

@section('title')
<title>Administrar Categorias | Calzado Amaya</title>
@endsection

@section('content')
@section('content')
    <h1 class="text-2xl font-semibold mb-4">Administrar Categorías</h1>

    <!-- Crear Categoría Modal -->

    <h2 class="text-lg font-semibold mb-2">Listado de Categorías</h2>
    <button type="button" class="btn btn-success mb-2" id="toggleCrearCategoriaModal" data-bs-toggle-modal="#crearCategoriaModal">Crear Categoría</button>
    <ul>
        @foreach($categorias as $categoria)
            <li>{{ $categoria->nombre }} <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary">Editar</a></li>
        @endforeach
    </ul>

    <x-modal id="crearCategoriaModal" title="Crear Categoría">
        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nombre" class="block mb-1">Nombre de la categoría</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre de la categoría" class="form-input w-full">
            </div>
            <button type="submit" class="btn btn-success w-full">Crear</button>
        </form>
    </x-modal>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Obtener el modal y el botón de activación
        const modal = document.getElementById('crearCategoriaModal');
        const toggleButton = document.getElementById('toggleCrearCategoriaModal');

        // Función para mostrar u ocultar el modal
        function toggleModal() {
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
        }

        // Event listener para el botón de activación
        toggleButton.addEventListener('click', function() {
            toggleModal();
        });

        // Event listener para el botón de cierre del modal
        const closeButton = modal.querySelector('.btn-close');
        closeButton.addEventListener('click', function() {
            toggleModal();
        });
    });
    </script>
@endsection