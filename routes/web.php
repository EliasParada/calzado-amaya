<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin/index');
})->name('home');

Route::get('promociones', function () {
    return view('build/promo');
})->name('promo');

Route::get('producto/{id}', function () {
    return view('build/producto');
})->name('producto');

Route::get('carrito', function () {
    return view('build/carrito');
})->name('carrito');

// Route::get('categorias', function () {
//     return view('build/categorias');
// })->name('categorias');

Route::get('categorias', [App\Http\Controllers\categoriasControlador::class, 'index'])->name('categorias');
Route::post('categorias', [App\Http\Controllers\categoriasControlador::class, 'store'])->name('categorias.store');
Route::put('categorias', [App\Http\Controllers\categoriasControlador::class, 'update'])->name('categorias.edit');

Route::get('productos', function () {
    return view('admin/productos');
})->name('productos');