<?php

namespace App\Http\Controllers;

use App\Models\promosiones;
use App\Models\productos;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class promoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = productos::all();
        if (Auth::check() && Auth::user()->administrador) {
            $promociones = promosiones::all();
            return view('admin.promo', compact('promociones', 'productos'));
        }
        $now = Carbon::now();
        $promociones = promosiones::where('fecha_inicio', '<=', $now)
            ->where('fecha_fin', '>=', $now)
            ->get();

        return view('build.promo', compact('promociones'));
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
        $promocion = new promosiones();
        $promocion->producto_id = $request->producto_id;
        $promocion->descuento = $request->descuento;
        $promocion->fecha_inicio = $request->fecha_inicio;
        $promocion->fecha_fin = $request->fecha_fin;
        $promocion->save();

        return redirect()->route('promo')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(promosiones $promosiones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(promosiones $promosiones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, promosiones $promosiones, $promocion_id)
    {
        $promocion = promosiones::find($promocion_id);
        // dd($promocion);
        $promocion->producto_id = $request->producto_id;
        $promocion->descuento = $request->descuento;
        $promocion->fecha_inicio = $request->fecha_inicio;
        $promocion->fecha_fin = $request->fecha_fin;
        $promocion->save();
        return redirect()->route('promo')->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(promosiones $promosiones, $promocion_id)
    {
        $promocion = promosiones::find($promocion_id);
        $promocion->delete();
        return redirect()->route('promo')->with('success', 'Categoría eliminada correctamente.');
    }
}
