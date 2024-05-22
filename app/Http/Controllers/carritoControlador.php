<?php

namespace App\Http\Controllers;

use App\Models\productos;
use App\Models\compras;
use App\Models\detalleCompras;
use App\Models\usuarios;
use App\Models\puntosUsuarios;
use Illuminate\Http\Request;
use App\Lib\Services\Pagadito;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $producto_id = $request->input('producto_id');
        $cantidad = $request->input('cantidad');

        $producto = productos::find($producto_id);

        $precio = $producto->precio_venta;;
        $nombre = $producto->nombre;
        $desuento = false;

        if ($producto->descuento) {
            $nombre = $producto->nombre . " -" . ($producto->descuento->descuento * 100) . "%";
            $precio = $producto->precio_venta - ($producto->descuento->descuento * $producto->precio_venta);
            $desuento = true;
        }

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
            'nombre' => $nombre,
            'precio_unidad' => $precio,
            'imagenes' => $producto->imagenes,
            'cantidad' => $cantidad,
            'color' => $request->color,
            'talla' => $request->talla,
            'descuento' => $desuento,
        ];

        $carrito[] = $producto;

        session()->put('carrito', $carrito);

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    public function show(productos $productos)
    {
        //
    }

    public function edit(productos $productos)
    {
        //
    }

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

    public function destroy(productos $productos)
    {
        session()->forget('carrito');
        return redirect()->back()->with('success', 'El carrito se ha vaciado correctamente');
    }

    public function envio(Request $request) {
        $carrito = session()->get('carrito', []);

        foreach ($carrito as $key => $item) {
            $producto = productos::findOrFail($item['producto_id']);
            $carrito[$key]['cantidad_disponible'] = $producto->existencia;
        }

        $subtotal = array_sum(array_map(function($item) {
            return $item['precio_unidad'] * $item['cantidad'];
        }, $carrito));

        return view('build.checkout', ['carrito' => $carrito, 'subtotal' => $subtotal]);
    }

    private function usuarioHaCompradoHoy($usuarioId)
    {
        $hoy = Carbon::today();
        return compras::whereDate('fecha_compra', $hoy)
                    ->where('usuario_id', $usuarioId)
                    ->exists();
    }

    private function contarComprasDelDia()
    {
        $hoy = Carbon::today();
        return compras::whereDate('fecha_compra', $hoy)
                    ->whereNotNull('usuario_id')
                    ->count('usuario_id');
    }

    public function enviar(Request $request) {
        $carrito = session()->get('carrito', []);

        $libras = 0;
        
        foreach ($carrito as $key => $item) {
            $producto = productos::findOrFail($item['producto_id']);
            $carrito[$key]['cantidad_disponible'] = $producto->existencia;
            $libras += $producto->peso * $carrito[$key]['cantidad'];
        }

        $subtotal = array_sum(array_map(function($item) {
            return $item['precio_unidad'] * $item['cantidad'];
        }, $carrito));

        $usuarioId = Auth::check() ? Auth::user()->usuario_id : null;
        $comprasDelDia = $this->contarComprasDelDia();
    
        if ($usuarioId && !$this->usuarioHaCompradoHoy($usuarioId)) {
            // Aplicar descuento del primer día: envío gratis
            if ($comprasDelDia < 50 && $subtotal > 20) {
                $libras = 0.00;
            } else {
                $libras *= 3.5;
            }
        } else {
            // Precio de envío normal
            $libras *= 3.5;
        }
        return view('build.envio', ['carrito' => $carrito, 'subtotal' => $subtotal, 'contacto' => $request->all(), 'envio' => $libras]);
    }

    public function pago(Request $request) {
        $carrito = session()->get('carrito', []);

        $libras = 0;
        
        foreach ($carrito as $key => $item) {
            $producto = productos::findOrFail($item['producto_id']);
            $carrito[$key]['cantidad_disponible'] = $producto->existencia;
            $libras += $producto->peso * $carrito[$key]['cantidad'];
        }

        $subtotal = array_sum(array_map(function($item) {
            return $item['precio_unidad'] * $item['cantidad'];
        }, $carrito));

        $usuarioId = Auth::check() ? Auth::user()->usuario_id : null;
        $comprasDelDia = $this->contarComprasDelDia();
    
        if ($usuarioId && !$this->usuarioHaCompradoHoy($usuarioId)) {
            // Aplicar descuento del primer día: envío gratis
            if ($comprasDelDia < 50 && $subtotal > 20) {
                $libras = 0.00;
            } else {
                $libras *= 3.5;
            }
        } else {
            // Precio de envío normal
            $libras *= 3.5;
        }
        return view('build.metodo', ['carrito' => $carrito, 'subtotal' => $subtotal, 'contacto' => $request->all(), 'envio' => $libras]);
    }

    public function cobrar(Request $request)
    {
        $carrito = session()->get('carrito', []);

        $precioTotal = 0;
        $descuentoTotal = 0;
        foreach ($carrito as $item) {
            $precioTotal += $item['precio_unidad'] * $item['cantidad'];
        }

        $precioNeto = $precioTotal;
        $precioTotal += $request->envio;
        $comisionPagadito = $precioNeto * 0.05 + 0.25;

        $fechaHora = date('YmdHis');
        $numeroAleatorio = rand(100, 999);
        $ern = "CA-FACTURA-$fechaHora-$numeroAleatorio";
        
        $compra = compras::create([
            'usuario_id' => Auth::check() ? Auth::user()->usuario_id : NULL,
            'factura_nombre' => $ern,
            'fecha_compra' => date('Y-m-d H:i:s'),
            'ubicacion_envio' => $request->direccion,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'nombres' => $request->nombre,
            'apellidos' => $request->apellido,
            'descuento' => $descuentoTotal,
            'precio_total' => $precioTotal,
            'precio_evio' => $request->envio,
            'precio_neto' => $precioNeto,
            'comision_pagadito' => $comisionPagadito,
            'estado' => 'PENDIENTE',
            'metodo' => $request->metodo,
            'detalles' => $request->detalle,
        ]);

        if (Auth::check()) {
            $usuario = Auth::user();
            $puntos = 0;
    
            if ($precioNeto >= 20 && $precioNeto <= 25) {
                $puntos = $precioNeto * 0.01;
            } else if ($precioNeto > 25) {
                $puntos = $precioNeto * 0.02;
            }
    
            // Actualizar o crear los puntos del usuario
            $puntosUsuario = puntosUsuarios::where('usuario_id', $usuario->usuario_id)->first();
            if ($puntosUsuario) {
                $puntosUsuario->puntos += $puntos;
                $puntosUsuario->save();
            } else {
                puntosUsuarios::create(['usuario_id' => $usuario->usuario_id, 'puntos' => $puntos]);
            }
        }

        if ($request->metodo == "PAGADITO") {
            if($this->pagadito->connect()) {
                foreach ($carrito as $item) {
                    if (
                        detalleCompras::create([
                            'compra_id' => $compra->compra_id,
                            'producto_id' => $item['producto_id'],
                            'cantidad' => $item['cantidad'],
                        ])
                    ) {
                        $producto = productos::find($item['producto_id']);
                        $producto->existencia = $producto->existencia -  $item['cantidad'];
                        $producto->save();
                    }
                    $this->pagadito->add_detail($item['cantidad'], $item['nombre'], $item['precio_unidad']);
                }
                $this->pagadito->add_detail(1, 'Envio Cargo Expreso', $request->envio);
    
    
                if (!$this->pagadito->exec_trans($ern)) {
                    return "ERROR:" . $this->pagadito->get_rs_code() . ": " . $this->pagadito->get_rs_message();
                }
            } else {
                return "ERROR:" . $this->pagadito->get_rs_code() . ": " . $this->pagadito->get_rs_message();
            }
        } else {
            foreach ($carrito as $item) {
                if (
                    detalleCompras::create([
                        'compra_id' => $compra->compra_id,
                        'producto_id' => $item['producto_id'],
                        'cantidad' => $item['cantidad'],
                    ])
                ) {
                    $producto = productos::find($item['producto_id']);
                    $producto->existencia = $producto->existencia -  $item['cantidad'];
                    $producto->save();
                }
            }

            $fecha_cobro = $compra->fecha_compra;
            $subtotal = $compra->precio_neto;
            return view('build.pago', compact('fecha_cobro', 'subtotal', 'compra'));
        }
    }

    public function verificar(Request $request, $token, $ern)
    {
        if($this->pagadito->connect()) {
            if ($this->pagadito->get_status($token)) {
                $estado = $this->pagadito->get_rs_status();
                session()->forget('carrito');
                if ($estado == "COMPLETED") {
                    $compra = compras::where('factura_nombre', $ern)->first();
                    if ($compra) {
                        $compra->update(['estado' => 'COMPLETADO']);
                    }
                    
                    $fecha_cobro = $this->pagadito->get_rs_date_trans();
                    $subtotal = $this->pagadito->get_rs_value()->amount;
                    return view('build.pago', compact('fecha_cobro', 'subtotal', 'compra'));
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

    public function factura(Request $request, $token, $ern)
    {
        if($this->pagadito->connect()) {
            if ($this->pagadito->get_status($token)) {
                $estado = $this->pagadito->get_rs_status();
                if ($estado == "COMPLETED") {
                    $fecha_cobro = $this->pagadito->get_rs_date_trans();
                    $subtotal = $this->pagadito->get_rs_value()->amount;

                    $compra = compras::where('factura_nombre', $ern)->first();
                    if ($compra) {
                        $compra->update(['estado' => 'COMPLETADO', 'fecha_compra' => $fecha_cobro, 'precio_neto' => $subtotal]);
                    }

                    return view('build.pago', compact('fecha_cobro'));
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

    public function incrementar(Request $request, $productoId)
    {
        return $this->actualizarCantidad($request, $productoId, 1);
    }

    public function decrementar(Request $request, $productoId)
    {
        return $this->actualizarCantidad($request, $productoId, -1);
    }

    private function actualizarCantidad(Request $request, $productoId, $incremento)
    {
        // Verificar si el producto existe en el carrito
        $carrito = session()->get('carrito', []);
        $productoEnCarrito = collect($carrito)->firstWhere('producto_id', $productoId);

        if (!$productoEnCarrito) {
            return redirect()->back()->with(['error' => 'El producto no se encuentra en el carrito'], 404);
        }

        // Verificar si la nueva cantidad es válida
        $producto = productos::find($productoId);
        if (!$producto) {
            return redirect()->back()->with(['error' => 'El producto seleccionado no existe'], 404);
        }
        $cantidadNueva = $productoEnCarrito['cantidad'] + $incremento;
        if ($cantidadNueva < 1 || $cantidadNueva > $producto->existencia) {
            return redirect()->back()->with(['error' => 'La cantidad no es válida'], 400);
        }

        // Actualizar la cantidad del producto en el carrito
        foreach ($carrito as &$item) {
            if ($item['producto_id'] == $productoId) {
                $item['cantidad'] += $incremento;
                break;
            }
        }
        session()->put('carrito', $carrito);

        // Calcular el subtotal nuevamente (si es necesario)
        $subtotal = array_sum(array_map(function($item) {
            return $item['precio_unidad'] * $item['cantidad'];
        }, $carrito));

        return redirect()->back()->with(['success' => 'Cantidad actualizada en el carrito', 'subtotal' => $subtotal]);
    }
}
