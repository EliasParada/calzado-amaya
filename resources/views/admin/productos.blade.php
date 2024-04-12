@extends('layouts.app')

@section('title')
<title>Administrar Productos | Calzado Amaya</title>
@endsection

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Administrar Productos</h1>

    <button type="button" class="bg-white text-black border border-black hover:bg-gray-200 font-bold py-2 px-4 rounded mb-4" id="toggleCrearCategoriaModal" data-bs-toggle-modal="#crearCategoriaModal">Agregar Producto</button>

    <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre del
                        Producto</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio de
                        Compra</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio de
                        Venta</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Existencia</th>
                    <th scope="col" class="px-6 py-3"><span class="sr-only">Editar</span></th>
                    <th scope="col" class="px-6 py-3"><span class="sr-only">Eliminar</span></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($productos as $producto)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $producto->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $producto->categoria->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $producto->descripcion }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $producto->precio_compra }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $producto->precio_venta }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $producto->existencia }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button type="button" class="text-indigo-600 hover:text-indigo-900"
                                data-bs-toggle-modal="#editarProductoModal_{{ $producto->producto_id }}">Editar</button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button type="button" class="text-main-red hover:text-red-500"
                                data-bs-toggle-modal="#eliminarProductoModal_{{ $producto->producto_id }}">Eliminar</button>
                        </td>
                    </tr>

                    <x-modal id="editarProductoModal_{{ $producto->producto_id }}" title="Editar Producto">
                        <form action="{{ route('productos.update', $producto->producto_id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="categoria_editar" class="block mb-1">Categoría</label>
                                <select name="categoria_id" id="categoria_editar"
                                    class="w-full rounded-md px-4 py-2 outline-none focus:ring-2 focus:ring-main-yellow">
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}"
                                            {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="nombre_editar" class="block mb-1">Nuevo nombre del producto</label>
                                <input type="text" name="nombre" id="nombre_editar" value="{{ $producto->nombre }}" class="w-full rounded-md px-4 py-2 outline-none focus:ring-2 focus:ring-main-yellow">
                            </div>
                            <div class="mb-4">
                                <label for="descripcion_editar" class="block mb-1">Nueva descripción del producto</label>
                                <textarea name="descripcion" id="descripcion_editar" class="w-full rounded-md px-4 py-2 outline-none focus:ring-2 focus:ring-main-yellow">{{ $producto->descripcion }}</textarea>
                            </div>
                            <div class="mb-4">
                                @foreach (json_decode($producto->imagenes) as $imagen)
                                    <div class="mb-2">
                                        <img src="{{ asset('imagenes/' . $imagen) }}" alt="Vista Previa" class="w-16 h-16 rounded-md">
                                        <input type="file" name="imagenes[]" class="mt-2">
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-4">
                                <label for="precio_compra_editar" class="block mb-1">Nuevo precio de compra</label>
                                <input type="number" name="precio_compra" id="precio_compra_editar" value="{{ $producto->precio_compra }}" step="0.01" class="w-full rounded-md px-4 py-2 outline-none focus:ring-2 focus:ring-main-yellow">
                            </div>
                            <div class="mb-4">
                                <label for="precio_venta_editar" class="block mb-1">Nuevo precio de venta</label>
                                <input type="number" name="precio_venta" id="precio_venta_editar" value="{{ $producto->precio_venta }}" step="0.01" class="w-full rounded-md px-4 py-2 outline-none focus:ring-2 focus:ring-main-yellow">
                            </div>
                            <div class="mb-4">
                                <label for="existencia_editar" class="block mb-1">Nueva existencia</label>
                                <input type="number" name="existencia" id="existencia_editar" value="{{ $producto->existencia }}" class="w-full rounded-md px-4 py-2 outline-none focus:ring-2 focus:ring-main-yellow">
                            </div>
                            <button type="submit" class="rounded-lg bg-main-yellow text-secondary-black border-2 border-secondary-black w-full">Guardar cambios</button>
                        </form>
                    </x-modal>

                    <x-modal id="eliminarProductoModal_{{ $producto->producto_id }}" title="Eliminar Producto">
                        <p class="mb-4">¿Estás seguro de que deseas eliminar el producto "{{ $producto->nombre }}"?</p>
                        <form action="{{ route('productos.destroy', $producto->producto_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-lg bg-main-red text-white px-4 py-2 hover:bg-red-700">Eliminar</button>
                        </form>
                    </x-modal>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                            <p class="text-gray-600 mb-2">No hay productos disponibles.</p>
                            <p class="text-gray-600 mb-2 text-5xl"><i class="fa-solid fa-rectangle-list"></i></p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <x-modal id="crearCategoriaModal" title="Crear Categoría">
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="categoria_id" class="form-label">Categoría</label>
                <select class="form-select" id="categoria_id" name="categoria_id">
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->categoria_id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="imagenes" class="form-label">Imágenes</label>
                <input type="file" class="form-control" id="imagenes" name="imagenes[]" multiple required onchange="previewImages(this)">
                <div id="preview-container" class="mt-4 mb-4 grid grid-cols-3 gap-4"></div>
            </div>
            <div class="mb-3">
                <label for="precio_compra" class="form-label">Precio de compra</label>
                <input type="number" class="form-control" id="precio_compra" name="precio_compra" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="precio_venta" class="form-label">Precio de venta</label>
                <input type="number" class="form-control" id="precio_venta" name="precio_venta" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="existencia" class="form-label">Existencia</label>
                <input type="number" class="form-control" id="existencia" name="existencia" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Producto</button>
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

            // Vista previa de imagenes

        });

        function previewImages(input) {
            var previewContainer = document.getElementById('preview-container');
            previewContainer.innerHTML = ''; // Limpiar el contenedor

            var files = input.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var imageSrc = e.target.result;

                    var imageContainer = document.createElement('div');
                    imageContainer.classList.add('relative');

                    var image = document.createElement('img');
                    image.classList.add('rounded-md', 'cursor-pointer');
                    image.src = imageSrc;
                    image.style.maxWidth = '100%';
                    image.style.height = 'auto';

                    var deleteIcon = document.createElement('span');
                    deleteIcon.classList.add('absolute', 'top-0', 'right-0', 'text-red-500', 'cursor-pointer');
                    deleteIcon.innerHTML = '&times;';
                    deleteIcon.addEventListener('click', function() {
                        imageContainer.remove();
                        var index = Array.prototype.indexOf.call(previewContainer.children, imageContainer);
                        if (index !== -1) {
                            input.files.splice(index, 1);
                        }
                    });

                    imageContainer.appendChild(image);
                    imageContainer.appendChild(deleteIcon);
                    previewContainer.appendChild(imageContainer);
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection