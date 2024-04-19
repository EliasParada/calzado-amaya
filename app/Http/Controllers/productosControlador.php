<?php

namespace App\Http\Controllers;

use App\Models\productos;
use Illuminate\Http\Request;

class productosControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = productos::all();

        return view('admin.productos', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imagenesNombres = [];
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                $imagen->move(public_path('imagenes'), $nombreImagen);
                $imagenesNombres[] = $nombreImagen;
            }
        }

        $colores = $request->input('colores');
        $coloresJson = json_encode($colores);

        $tallas = $request->input('tallas');
        $tallasJson = json_encode($tallas);

        $producto = new productos();
        $producto->categoria_id = $request->categoria_id;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->colores = $coloresJson;
        $producto->tallas = $tallasJson;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->existencia = $request->existencia;
        $producto->imagenes = json_encode($imagenesNombres);
        $producto->save();

        return redirect()->route('productos')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(productos $productos, $producto_id)
    {
        $producto = productos::findOrFail($producto_id); // Suponiendo que tengas un modelo Producto

        return view('build.producto', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(productos $productos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, productos $productos, $productoID)
    {
        $producto = productos::find($productoID);

        $colores = $request->input('colores');
        $coloresJson = json_encode($colores);

        $tallas = $request->input('tallas');
        $tallasJson = json_encode($tallas);

        $producto->categoria_id = $request->categoria_id;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->colores = $coloresJson;
        $producto->tallas = $tallasJson;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->existencia = $request->existencia;
    
        // Manejar la eliminación de imágenes
        if ($request->has('imagenes-eliminar')) {
            $imagenesEliminar = explode(',', $request->input('imagenes-eliminar'));
    
            // Decodificar el JSON de imágenes del producto
            $imagenesProducto = json_decode($producto->imagenes);
    
            // Filtrar las imágenes del producto para eliminar las que estén en la lista de eliminación
            $imagenesProducto = array_filter($imagenesProducto, function ($imagen) use ($imagenesEliminar) {
                return !in_array($imagen, $imagenesEliminar);
            });
    
            // Eliminar los archivos de las imágenes a eliminar del servidor
            foreach ($imagenesEliminar as $imagenEliminar) {
                if ($imagenEliminar != "") {
                    $rutaImagen = public_path('imagenes/' . $imagenEliminar);
                    if (file_exists($rutaImagen) && is_file($rutaImagen)) {
                        unlink($rutaImagen);
                    }
                }
            }
    
            // Codificar nuevamente las imágenes del producto como JSON
            $producto->imagenes = json_encode(array_values($imagenesProducto));
        }
    
        // Subir y guardar nuevas imágenes
        $imagenesNombres = [];
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                $imagen->move(public_path('imagenes'), $nombreImagen);
                $imagenesNombres[] = $nombreImagen;
            }
        }
    
        // Agregar las nuevas imágenes al producto
        if (!empty($imagenesNombres)) {
            $imagenesProducto = json_decode($producto->imagenes);
            $imagenesProducto = array_merge($imagenesProducto, $imagenesNombres);
            $producto->imagenes = json_encode($imagenesProducto);
        }
    
        // Guardar los cambios en el producto
        $producto->save();
    
        return redirect()->route('productos')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(productos $productos, $producto_id)
    {
        $producto = productos::find($producto_id);
        $producto->delete();
        return redirect()->route('productos')->with('success', 'Categoría eliminada correctamente.');
    }
}
