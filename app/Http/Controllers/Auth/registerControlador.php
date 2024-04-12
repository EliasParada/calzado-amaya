<?php

namespace App\Http\Controllers\Auth;

use App\Models\usuarios;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class registerControlador extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(Request $request)
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'correo' => 'required|email|unique:usuarios,correo',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $usuario = usuarios::create([
                'nombre' => $request->nombre,
                'correo' => $request->correo,
                'password' => Hash::make($request->password),
            ]);
    
            Auth::login($usuario);

            return redirect()->route('home');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            return redirect()->back()->with('error', 'Error: Hubo un problema al registrar el usuario.');
        }
    }
}
