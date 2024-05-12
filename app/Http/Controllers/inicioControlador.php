<?php

namespace App\Http\Controllers;

use App\Models\categorias;
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

        return view('build.index', compact('categorias'));
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
