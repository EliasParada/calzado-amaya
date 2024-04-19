<?php

namespace App\Http\Controllers;

use App\Models\productos;
use Illuminate\Http\Request;

class carritoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carrito = session()->get('carrito', []);

        foreach ($carrito as $key => $item) {
            $producto = productos::findOrFail($item['producto_id']);
            $carrito[$key]['cantidad_disponible'] = $producto->existencia;
        }

        $subtotal = array_sum(array_map(function($item) {
            return $item['precio_unidad'] * $item['cantidad'];
        }, $carrito));

        return view('build/carrito', ['carrito' => $carrito, 'subtotal' => $subtotal]);
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
        $producto_id = $request->input('producto_id');
        $cantidad = $request->input('cantidad');

        $producto = productos::find($producto_id);

        if ($cantidad < 1) {
            return redirect()->back()->with('error', 'La cantidad debe ser al menos 1');
        }
    
        if (!$producto) {
            return redirect()->back()->with('error', 'El producto seleccionado no existe');
        }

        $carrito = session()->get('carrito', []);

        foreach ($carrito as $key => $item) {
            if ($item['producto_id'] == $producto_id) {
                $carrito[$key]['cantidad'] += $cantidad;
                if ($carrito[$key]['cantidad'] > $producto->existencia) {
                    $carrito[$key]['cantidad'] = $producto->existencia;
                }
                session()->put('carrito', $carrito);
                return redirect()->back()->with('success', 'Cantidad actualizada en el carrito');
            }
        }

        $producto = [
            'producto_id' => $producto_id,
            'nombre' => $producto->nombre,
            'precio_unidad' => $producto->precio_venta,
            'imagenes' => $producto->imagenes,
            'cantidad' => $cantidad,
            'color' => $request->color,
            'talla' => $request->talla,
        ];

        $carrito[] = $producto;

        session()->put('carrito', $carrito);

        return redirect()->back()->with('success', 'Producto agregado al carrito');
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
    public function update(Request $request, productos $productos, $producto_id)
    {
        $carrito = session()->get('carrito', []);

        $indiceProducto = array_search($producto_id, array_column($carrito, 'producto_id'));

        if ($indiceProducto !== false) {
            unset($carrito[$indiceProducto]);
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(productos $productos)
    {
        session()->forget('carrito');
        return redirect()->back()->with('success', 'El carrito se ha vaciado correctamente');
    }
}
