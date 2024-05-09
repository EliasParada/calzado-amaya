<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use App\Models\productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class categoriasControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->administrador) {
            return view('admin.categorias');
        }
    
        $query = productos::query();

        if ($request->has('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->has('categorias')) {
            $categoriasSeleccionadas = $request->categorias;
            $query->whereHas('categoria', function ($q) use ($categoriasSeleccionadas) {
                $q->whereIn('categoria_id', $categoriasSeleccionadas);
            });
        }

        $productos = $query->paginate(12);
        
        return view('build.categorias', compact('productos'));
    }

    public function create()
    {
        // return view('admin.categorias');
    }

    public function store(Request $request)
    {
        $categoria = new categorias();
        $categoria->nombre = $request->nombre;
        $categoria->save();
        return redirect()->route('categorias')->with('success', 'Categoría creada correctamente.');
    }

    public function show(categorias $categorias)
    {
        //
    }

    public function edit(categorias $categorias)
    {
        // 
    }

    public function update(Request $request, categorias $categorias)
    {
        $categoria = categorias::find($request->categoria_id);
        $categoria->nombre = $request->nombre;
        $categoria->save();
        return redirect()->route('categorias')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(categorias $categorias, $categoria_id)
    {
        $categoria = categorias::find($categoria_id);
        $categoria->delete();
        return redirect()->route('categorias')->with('success', 'Categoría eliminada correctamente.');
    }
}
