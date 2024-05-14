<?php

namespace App\Http\Controllers;

use App\Models\compras;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class comprasControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->administrador) {
            $pedidos = compras::all();
            return view('admin.pedidos', compact('pedidos'));
        }
        $pedidos = compras::where('usuario_id', Auth::user()->usuario_id)->get();

        return view('build.pagos', compact('pedidos'));
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
    public function store(Request $request, $compra_id)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(compras $compras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(compras $compras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, compras $compras, $compra_id)
    {
        $pedido = compras::findOrFail($compra_id);

        $pedido->estado = $request->input('estado');
        $pedido->fecha_envio = $request->input('fecha_envio');
        $pedido->fecha_retiro = $request->input('fecha_retiro');

        $pedido->save();

        return redirect()->back()->with('success', 'Pedido actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(compras $compras)
    {
        //
    }
}
