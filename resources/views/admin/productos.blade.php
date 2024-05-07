@extends('layouts.app')

@section('title')
    <title>Administrar Productos | Calzado Amaya</title>
    <style>
        input[type="checkbox"]:checked + label {
            background-color: black;
            color: white;
        }
    </style>
@endsection

@section('content')
@php
$colores = ['Rojo', 'Azul', 'Blanco', 'Café', 'Morado', 'Beige', 'Gris', 'Rosado', 'Anaranjado', 'Ocre','Negro'];

$tallas = [
    [24,25,26,27,28,29,30,31,32],
    [35,36,37,38,39,40,41,42,43]
];
@endphp
<div class="p-4">
    <h1 class="text-2xl font-semibold mb-4">Administrar Productos</h1>

    <button type="button" class="bg-white text-black border border-black hover:bg-gray-200 font-bold py-2 px-4 rounded mb-4" id="toggleCrearCategoriaModal" data-bs-toggle-modal="#crearCategoriaModal">Agregar Producto</button>

    <div class="overflow-x-auto shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
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
                        <td class="px-6 py-4">{{ $producto->codigo }}</td>
                        <td class="px-6 py-4">{{ $producto->nombre }}</td>
                        <td class="px-6 py-4">{{ $producto->categoria->nombre }}</td>
                        <td class="px-6 py-4">{{ $producto->descripcion }}</td>
                        <td class="px-6 py-4">{{ $producto->precio_compra }}</td>
                        <td class="px-6 py-4">{{ $producto->precio_venta }}</td>
                        <td class="px-6 py-4">{{ $producto->existencia }}</td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <button type="button" class="text-indigo-600 hover:text-indigo-900"
                                data-bs-toggle-modal="#editarProductoModal_{{ $producto->producto_id }}">Editar</button>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <button type="button" class="text-main-red hover:text-red-500"
                                data-bs-toggle-modal="#eliminarProductoModal_{{ $producto->producto_id }}">Eliminar</button>
                        </td>
                    </tr>

                    <x-modal id="editarProductoModal_{{ $producto->producto_id }}" title="Editar Producto">
                        <form action="{{ route('productos.update', $producto->producto_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="codigo_editar" class="block text-sm font-medium text-gray-700">Nuevo código del producto</label>
                                <input type="text" name="codigo" id="codigo_editar" value="{{ $producto->codigo }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50">
                            </div>
                            <div class="mb-4">
                                <label for="categoria_editar" class="block text-sm font-medium text-gray-700">Categoría</label>
                                <select name="categoria_id" id="categoria_editar" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50">
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->categoria_id }}"
                                            {{ $producto->categoria_id == $categoria->categoria_id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="nombre_editar" class="block text-sm font-medium text-gray-700">Nuevo nombre del producto</label>
                                <input type="text" name="nombre" id="nombre_editar" value="{{ $producto->nombre }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50">
                            </div>
                            <div class="mb-4">
                                <label for="descripcion_editar" class="block text-sm font-medium text-gray-700">Nueva descripción del producto</label>
                                <textarea name="descripcion" id="descripcion_editar" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50">{{ $producto->descripcion }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Colores</label>
                                <div class="flex gap-4 flex-wrap">
                                    @foreach ($colores as $index => $color)
                                        <input type="checkbox" id="color-{{ $index }}-{{ $producto->producto_id }}" name="colores[]" value="{{ $color }}" class="mr-2 hidden" {{ $producto->colores && in_array($color, json_decode($producto->colores)) ? 'checked' : '' }}>
                                        <label for="color-{{ $index }}-{{ $producto->producto_id }}" class="flex items-center block border-2 border-black text-black py-2 px-4 hover:bg-black hover:text-white cursor-pointer">
                                            <span>{{ $color }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Tallas</label>
                                @foreach ($tallas as $grupoIndex => $grupo)
                                    <div class="flex gap-4 flex-wrap mb-2">
                                        @foreach ($grupo as $tallaIndex => $talla)
                                            <input type="checkbox" id="tallas-{{ $grupoIndex }}-{{ $tallaIndex }}-{{ $producto->producto_id }}" name="tallas[]" value="{{ $talla }}" class="mr-2 hidden" {{ $producto->tallas && in_array($talla, json_decode($producto->tallas)) ? 'checked' : '' }}>
                                            <label for="tallas-{{ $grupoIndex }}-{{ $tallaIndex }}-{{ $producto->producto_id }}" class="flex items-center block border-2 border-black text-black py-2 px-4 hover:bg-black hover:text-white cursor-pointer">
                                                <span>{{ $talla }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>

                            <input type="hidden" name="imagenes-eliminar" id="imagenes-eliminar-{{ $producto->producto_id }}">
                            <div class="mb-4">
                                <label for="nueva-imagen-{{ $producto->producto_id }}" class="block text-sm font-medium text-gray-700">Imágenes</label>
                                <label for="imagenes_editar" class="block text-sm font-medium text-gray-500">Imágenes Actuales</label>
                                <div class="overflow-x-auto flex gap-2 justify-start max-w-full flex-wrap">
                                    @foreach (json_decode($producto->imagenes) as $imagen)
                                        <div class="relative">
                                            <img src="{{ asset('imagenes/' . $imagen) }}" alt="Vista Previa" class="w-24 h-24 rounded-md">
                                            <button type="button" class="absolute top-0 right-0 text-red-500 bg-white rounded-full p-1" onclick="removeImage(this, '{{ $imagen }}', '{{ $producto->producto_id }}')">&times;</button>
                                        </div>
                                    @endforeach
                                </div>
                                <label for="imagenes_editar" class="block text-sm font-medium text-gray-500">Agregar imagenes</label>
                                <label for="nueva-imagen-{{ $producto->producto_id }}" class="block w-full px-4 py-2 text-sm text-center text-black bg-yellow-600 rounded cursor-pointer hover:bg-yellow-700">
                                    Seleccionar imágenes
                                    <input type="file" class="hidden" id="nueva-imagen-{{ $producto->producto_id }}" name="nueva-imagen[]" multiple onchange="actualizarImagen(this, '{{ $producto->producto_id }}')" accept="image/*">
                                    <input type="file" name="imagenes[]" id="imagenes-{{ $producto->producto_id }}" class="hidden" multiple >
                                </label>
                                <div id="preview-container-{{ $producto->producto_id }}" class="mt-4 mb-4 grid grid-cols-3 gap-4"></div>
                            </div>

                            <div class="mb-4">
                                <label for="precio_compra_editar" class="block text-sm font-medium text-gray-700">Nuevo precio de compra</label>
                                <input type="number" name="precio_compra" id="precio_compra_editar" value="{{ $producto->precio_compra }}" step="0.01" min="0.00" class="block w-full mt-1 p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50">
                            </div>
                            <div class="mb-4">
                                <label for="precio_venta_editar" class="block text-sm font-medium text-gray-700">Nuevo precio de venta</label>
                                <input type="number" name="precio_venta" id="precio_venta_editar" value="{{ $producto->precio_venta }}" step="0.01" min="0.00" class="block w-full mt-1 p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50">
                            </div>
                            <div class="mb-4">
                                <label for="existencia_editar" class="block text-sm font-medium text-gray-700">Nueva existencia</label>
                                <input type="number" name="existencia" id="existencia_editar" value="{{ $producto->existencia }}" step="1" min="0" class="block w-full mt-1 p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50">
                            </div>
                            <button type="submit" class="px-4 py-2 text-black border-2 border-black hover:bg-black hover:text-white">Guardar cambios</button>
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
</div>

    <x-modal id="crearCategoriaModal" title="Crear Producto">
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="codigo" class="block text-sm font-medium text-gray-700">Código</label>
                <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="codigo" name="codigo" required>
            </div>
            <div class="mb-4">
                <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                <select class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="categoria_id" name="categoria_id">
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->categoria_id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="nombre" name="nombre" required>
            </div>
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>
            <div class="mb-4">
                <label for="colores" class="block text-sm font-medium text-gray-700">Colores Disponibles</label>
                <div class="space-y-2">
                    <div class="flex gap-4 flex-wrap">
                        @foreach ($colores as $index => $color)
                            <input type="checkbox" id="color-{{ $index }}" name="color" value="{{ $color }}" class="mr-2 hidden">
                            <label for="color-{{ $index }}" class="flex items-center block border-2 border-black text-black py-2 px-4 hover:bg-black hover:text-white cursor-pointer">
                                <span>{{ $color }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="tallas" class="block text-sm font-medium text-gray-700">Tallas Disponibles</label>
                @foreach ($tallas as $grupoIndex => $grupo)
                    <div class="flex gap-4 flex-wrap mb-2">
                        @foreach ($grupo as $tallaIndex => $talla)
                            <input type="checkbox" id="tallas-{{ $grupoIndex }}-{{ $tallaIndex }}" name="talla" value="{{ $talla }}" class="mr-2 hidden">
                            <label for="tallas-{{ $grupoIndex }}-{{ $tallaIndex }}" class="flex items-center block border-2 border-black text-black py-2 px-4 hover:bg-black hover:text-white cursor-pointer">
                                <span>{{ $talla }}</span>
                            </label>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <div class="mb-4">
                <label for="nueva_imagen" class="block text-sm font-medium text-gray-700">Imágenes</label>
                <label for="nueva_imagen" class="block w-full px-4 py-2 text-sm text-center text-black bg-yellow-600 rounded cursor-pointer hover:bg-yellow-700">
                    Seleccionar imágenes
                    <input type="file" class="hidden" id="nueva_imagen" name="nueva_imagen[]" multiple accept="image/*">
                    <input type="file" name="imagenes[]" id="imagenes" class="hidden" multiple >
                </label>
                <div id="preview-container" class="mt-4 mb-4 grid grid-cols-3 gap-4"></div>
            </div>
            <div class="mb-4">
                <label for="precio_compra" class="block text-sm font-medium text-gray-700">Precio de compra</label>
                <input type="number" class="block w-full mt-1 p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="precio_compra" name="precio_compra" step="1" min="0.00" required>
            </div>
            <div class="mb-4">
                <label for="precio_venta" class="block text-sm font-medium text-gray-700">Precio de venta</label>
                <input type="number" class="block w-full mt-1 p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="precio_venta" name="precio_venta" step="1" min="0.00" required>
            </div>
            <div class="mb-4">
                <label for="existencia" class="block text-sm font-medium text-gray-700">Existencia</label>
                <input type="number" class="block w-full mt-1 p-4 outline-none focus:ring focus:ring-main-yellow focus:ring-opacity-50" id="existencia" name="existencia" step="1" min="1" required>
            </div>
            <button type="submit" class="px-4 py-2 text-black border-2 border-black hover:bg-black hover:text-white">Agregar Producto</button>
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

        let input = document.getElementById('nueva_imagen');
        let imagenes = document.getElementById('imagenes');
        let previewContainer = document.getElementById('preview-container');

        input.addEventListener('change', function() {
            let files = input.files;
            let imagenesAnteriores = Array.from(imagenes.files);

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var newImage = files.item(i);
                imagenesAnteriores.push(newImage);
                
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
                        let arrayImagenes = imagenesAnteriores = Array.from(imagenes.files);
                        var index = arrayImagenes.indexOf(newImage);
                        if (index !== -1) {
                            arrayImagenes.splice(index, 1);
                            let nuevoFileList = new DataTransfer();
                            arrayImagenes.forEach(function(archivo) {
                                nuevoFileList.items.add(archivo);
                            });
                            imagenes.files = nuevoFileList.files;
                        }
                    });

                    imageContainer.appendChild(image);
                    imageContainer.appendChild(deleteIcon);
                    previewContainer.appendChild(imageContainer);
                };

                reader.readAsDataURL(file);
            }

            let nuevoFileList = new DataTransfer();
            imagenesAnteriores.forEach(function(archivo) {
                nuevoFileList.items.add(archivo);
            });

            imagenes.files = nuevoFileList.files;
        });

        function removeImage(button, imageName, productoID) {
            button.parentNode.remove();

            var imageNamesInput = document.getElementById(`imagenes-eliminar-${productoID}`);
            var imageNames = imageNamesInput.value.split(',');
            imageNames.push(imageName);
            imageNamesInput.value = imageNames.join(',');
        }

        function actualizarImagen(button, productoID) {

            let nuevasImagenes = document.getElementById(`nueva-imagen-${productoID}`);
            let imagenesActualizar = document.getElementById(`imagenes-${productoID}`);
            let previewContainerID = document.getElementById(`preview-container-${productoID}`);
            
            let files = nuevasImagenes.files;
            let imagenesAnteriores = Array.from(imagenesActualizar.files);

            for (var i = 0; i < files.length; i++) {
                let file = files[i];
                let newImage = files.item(i);
                imagenesAnteriores.push(newImage);
                
                let reader = new FileReader();

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
                        let arrayImagenes = imagenesAnteriores = Array.from(imagenesActualizar.files);
                        var index = arrayImagenes.indexOf(newImage);
                        if (index !== -1) {
                            arrayImagenes.splice(index, 1);
                            let nuevoFileList = new DataTransfer();
                            arrayImagenes.forEach(function(archivo) {
                                nuevoFileList.items.add(archivo);
                            });
                            imagenesActualizar.files = nuevoFileList.files;
                        }
                    });

                    imageContainer.appendChild(image);
                    imageContainer.appendChild(deleteIcon);
                    previewContainerID.appendChild(imageContainer);
                };

                reader.readAsDataURL(file);
            }

            let nuevoFileList = new DataTransfer();
            imagenesAnteriores.forEach(function(archivo) {
                nuevoFileList.items.add(archivo);
            });

            imagenesActualizar.files = nuevoFileList.files;
        }

    </script>
@endsection