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
        // dd($request);

        // $request->validate([
        //     'nombre' => 'required',
        //     'descripcion' => 'required',
        //     'precio_compra' => 'required',
        //     'precio_venta' => 'required',
        //     'existencia' => 'required',
        //     'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Asegúrate de que se puedan subir imágenes y de que cumplan con los requisitos de tamaño y formato
        // ]);

        $imagenesNombres = [];
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                $imagen->move(public_path('imagenes'), $nombreImagen);
                $imagenesNombres[] = $nombreImagen;
            }
        }

        $producto = new productos();
        $producto->categoria_id = $request->categoria_id;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
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
    public function show(productos $productos)
    {
        //
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
    public function update(Request $request, productos $productos)
    {
        //
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
