<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use App\Models\productos;
use App\Models\promosiones;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class inicioControlador extends Controller
{
    public function index()
    {
        $categorias = categorias::all();
        if (Auth::check() && Auth::user()->administrador) {
            return view('admin.index', compact('categorias'));
        }

        $productosMasVendidos = productos::select('productos.producto_id', 'productos.nombre', 'productos.descripcion', 'productos.imagenes', 'productos.precio_venta', DB::raw('SUM(detalle_compras.cantidad) as total_vendido'))
            ->join('detalle_compras', 'productos.producto_id', '=', 'detalle_compras.producto_id')
            ->groupBy('productos.producto_id', 'productos.nombre', 'productos.descripcion', 'productos.imagenes', 'productos.precio_venta', 'productos.imagenes')
            ->orderByDesc('total_vendido')
            ->limit(3)
            ->get();

        $now = Carbon::now();

        $promociones = promosiones::where('fecha_inicio', '<=', $now)
            ->where('fecha_fin', '>=', $now)
            ->limit(3)
            ->get();
        
        return view('build.index', compact('categorias', 'productosMasVendidos', 'promociones'));
    }
    public function contacto()
    {
        return view('build.contacto');
    }
    public function nosotros()
    {
        return view('build.nosotros');
    }

    public function pedidos()
    {
        // $categorias = categorias::all();
        if (Auth::check() && Auth::user()->administrador) {
            // return view('admin.index', compact('categorias'));
        }

        return view('build.pagos');
    }
}
