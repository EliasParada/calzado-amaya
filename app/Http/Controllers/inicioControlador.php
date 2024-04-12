<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class inicioControlador extends Controller
{
    public function index()
    {
        // $this->middleware(['auth', 'password.changed']);
        return view('admin/index');
    }
}
