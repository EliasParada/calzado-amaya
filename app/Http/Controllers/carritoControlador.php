<?php

namespace App\Http\Controllers;

use App\Models\productos;
use App\Models\compras;
use Illuminate\Http\Request;
use App\Lib\Services\Pagadito;
use Illuminate\Support\Facades\Auth;

require_once(__DIR__. '../../../services/config.php');
require_once(__DIR__. '../../../services/lib/Pagadito.php');

class carritoControlador extends Pagadito
{

    protected $pagadito;

    public function __construct()
    {
        $this->pagadito = new Pagadito(UID, WSK);
        
        if (SANDBOX) {
            $this->pagadito->mode_sandbox_on();
        }
    }
    
    
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

    public function cobrar()
    {
        $carrito = session()->get('carrito', []);

        $precioTotal = 0;
        $descuentoTotal = 0;
        foreach ($carrito as $item) {
            $precioTotal += $item['precio_unidad'] * $item['cantidad'];
        }

        $precioNeto = $precioTotal - $descuentoTotal;
        $comisionPagadito = $precioNeto * 0.05 + 0.25;

        $fechaHora = date('YmdHis');
        $numeroAleatorio = rand(100, 999);
        $ern = "CA-FACTURA-$fechaHora-$numeroAleatorio";
        
        $compra = compras::create([
            'factura_nombre' => $ern,
            'fecha_compra' => date('Y-m-d H:i:s'),
            'ubicacion_envio' => 'Aqui',
            'descuento' => $descuentoTotal,
            'precio_real' => 0,
            'precio_total' => $precioTotal,
            'precio_neto' => $precioNeto,
            'comision_pagadito' => $comisionPagadito,
            'estado' => 'PENDIENTE',
        ]);

        if($this->pagadito->connect()) {
            foreach ($carrito as $item) {
                $this->pagadito->add_detail($item['cantidad'], $item['nombre'], $item['precio_unidad']);
            }

            if (!$this->pagadito->exec_trans($ern)) {
                return "ERROR:" . $this->pagadito->get_rs_code() . ": " . $this->pagadito->get_rs_message();
            }
        } else {
            return "ERROR:" . $this->pagadito->get_rs_code() . ": " . $this->pagadito->get_rs_message();
        }
    }

    public function verificar(Request $request, $token, $ern)
    {
        if($this->pagadito->connect()) {
            if ($this->pagadito->get_status($token)) {
                $estado = $this->pagadito->get_rs_status();
                echo "Estado: " . $estado . "\n";
                if ($estado == "COMPLETED") {
                    $compra = compras::where('factura_nombre', $ern)->first();
                    if ($compra) {
                        $compra->update(['estado' => 'COMPLETADO']);
                    }
                    return view('build.pago', compact('fecha_cobro', 'numero_aprobacion_pg'));
                } else {
                    // Si el estado es distinto
                }
            } else {
                echo "ERROR:" . $this->pagadito->get_rs_code() . ": " . $this->pagadito->get_rs_message() . "\n";
            }
        } else {
            echo "ERROR:" . $this->pagadito->get_rs_code() . ": " . $this->pagadito->get_rs_message() . "\n";
        }
    }
}
