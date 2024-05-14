<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use App\Models\productos;
use Illuminate\Support\Facades\DB;
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

        if ($request->has('ordenar')) {
            switch ($request->ordenar) {
                case 'popular':
                    $query->select('productos.*')
                        ->leftJoin('detalle_compras', 'productos.producto_id', '=', 'detalle_compras.producto_id')
                        ->groupBy('productos.producto_id', 'productos.categoria_id', 'productos.nombre', 'productos.descripcion', 'productos.precio_venta', 'productos.imagenes', 'productos.codigo', 'productos.colores', 'productos.tallas',  'productos.existencia',  'productos.precio_compra')
                        ->orderByDesc(DB::raw('COUNT(detalle_compras.producto_id)'))
                        ->orderBy('nombre');
                    break;
                case 'precio':
                    $query->select('productos.*', DB::raw('IFNULL(promociones.descuento, 1) * productos.precio_venta AS precio_descuento'))
                        ->leftJoin('promociones', 'productos.producto_id', '=', 'promociones.producto_id')
                        ->orderBy('precio_descuento')
                        ->orderBy('productos.precio_venta');
                    break;
                case 'existencias':
                    $query->orderBy('existencia');
                    break;
                default:
                    $query->orderBy('nombre');
                    break;
            }
        } else {
            $query->orderBy('nombre');
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
