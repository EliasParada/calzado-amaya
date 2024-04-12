<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class categoriasControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->administrador) {
            return view('admin.categorias');
        }

        return view('build.categorias');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoria = new categorias();
        $categoria->nombre = $request->nombre;
        $categoria->save();
        return redirect()->route('categorias')->with('success', 'Categoría creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(categorias $categorias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categorias $categorias)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, categorias $categorias)
    {
        $categoria = categorias::find($request->categoria_id);
        $categoria->nombre = $request->nombre;
        $categoria->save();
        return redirect()->route('categorias')->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categorias $categorias, $categoria_id)
    {
        $categoria = categorias::find($categoria_id);
        $categoria->delete();
        return redirect()->route('categorias')->with('success', 'Categoría eliminada correctamente.');
    }
}
