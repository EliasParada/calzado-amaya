<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use App\Models\productos;
use App\Models\promosiones;
use App\Models\compras;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class inicioControlador extends Controller
{
    public function index()
    {
        $categorias = categorias::all();
        $carrito = session()->get('carrito', []);
        if (Auth::check() && Auth::user()->administrador) {
            $productosMasVendidos = productos::select('productos.producto_id', 'productos.nombre', 'productos.descripcion', 'productos.imagenes', 'productos.precio_venta', DB::raw('SUM(detalle_compras.cantidad) as total_vendido'))
            ->join('detalle_compras', 'productos.producto_id', '=', 'detalle_compras.producto_id')
            ->groupBy('productos.producto_id', 'productos.nombre', 'productos.descripcion', 'productos.imagenes', 'productos.precio_venta', 'productos.imagenes')
            ->orderByDesc('total_vendido')
            ->get();

            $ingresosVentasMes = DB::table('compras')
                ->whereMonth('fecha_compra', Carbon::now()->month)
                ->sum('precio_neto');

            // Calcular la comisión total pagada a Pagadito en el mes
            $comisionPagaditoMes = DB::table('compras')
                ->whereMonth('fecha_compra', Carbon::now()->month)
                ->sum('comision_pagadito');

            // Preparar los datos para el gráfico
            $datosGrafico = [
                'Ingresos por ventas' => $ingresosVentasMes,
                'Comisión Pagadito' => $comisionPagaditoMes
            ];

            $categoriasVendidas = categorias::select('categorias.nombre', DB::raw('COUNT(detalle_compras.cantidad) as total_vendido'))
                ->join('productos', 'categorias.categoria_id', '=', 'productos.categoria_id')
                ->join('detalle_compras', 'productos.producto_id', '=', 'detalle_compras.producto_id')
                ->groupBy('categorias.nombre')
                ->orderByDesc('total_vendido')
                ->get();

            // Preparar los datos para el gráfico
            $labels = $categoriasVendidas->pluck('nombre');
            $data = $categoriasVendidas->pluck('total_vendido');

            return view('admin.index', compact('categorias','productosMasVendidos', 'datosGrafico', 'labels', 'data'));
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
        
        return view('build.index', compact('categorias', 'productosMasVendidos', 'promociones', 'carrito'));
    }
    public function contacto()
    {
        return view('build.contacto');
    }
    public function nosotros()
    {
        return view('build.nosotros');
    }
}
