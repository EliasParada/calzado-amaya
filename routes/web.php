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

// Route::get('/', function () {
//     return view('admin/index');
// })->name('home');

Route::get('/', [App\Http\Controllers\inicioControlador::class, 'index'])->name('home');

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
Route::post('categorias/{categoria_id}', [App\Http\Controllers\categoriasControlador::class, 'update'])->name('categorias.update');
Route::delete('categorias/{categoria_id}', [App\Http\Controllers\categoriasControlador::class, 'destroy'])->name('categorias.destroy');


Route::get('productos', [App\Http\Controllers\productosControlador::class, 'index'])->name('productos');
Route::post('productos', [App\Http\Controllers\productosControlador::class, 'store'])->name('productos.store');
Route::post('productos/{producto_id}', [App\Http\Controllers\productosControlador::class, 'update'])->name('productos.update');
Route::delete('productos/{producto_id}', [App\Http\Controllers\productosControlador::class, 'destroy'])->name('productos.destroy');
