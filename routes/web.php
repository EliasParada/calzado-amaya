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

Route::get('/', [App\Http\Controllers\inicioControlador::class, 'index'])->name('home');
Route::get('nosotros', [App\Http\Controllers\inicioControlador::class, 'nosotros'])->name('nosotros');
Route::get('contacto', [App\Http\Controllers\inicioControlador::class, 'contacto'])->name('contacto');

Route::get('login', [App\Http\Controllers\Auth\loginControlador::class, 'index'])->name('login');
Route::get('register', [App\Http\Controllers\Auth\registerControlador::class, 'index'])->name('register');
Route::post('login', [App\Http\Controllers\Auth\loginControlador::class, 'login'])->name('login.new');
Route::post('register', [App\Http\Controllers\Auth\registerControlador::class, 'register'])->name('register.new');
Route::post('logout', [App\Http\Controllers\Auth\logoutControlador::class, 'logout'])->name('logout');

Route::get('{nombre_usuario}/pedidos', [App\Http\Controllers\comprasControlador::class, 'index'])->name('historial.pedidos');

Route::get('carrito', [App\Http\Controllers\carritoControlador::class, 'index'])->name('carrito');
Route::post('carrito', [App\Http\Controllers\carritoControlador::class, 'store'])->name('carrito.store');
Route::post('carrito/vaciar', [App\Http\Controllers\carritoControlador::class, 'destroy'])->name('carrito.vaciar');
Route::post('carrito/{producto_id}', [App\Http\Controllers\carritoControlador::class, 'update'])->name('carrito.eliminar');
Route::post('verificar/envio', [App\Http\Controllers\carritoControlador::class, 'envio'])->name('envio');
Route::post('verificar/envio/metodo', [App\Http\Controllers\carritoControlador::class, 'enviar'])->name('checkout.envio');
Route::post('/carrito/incrementar/{productoId}', [App\Http\Controllers\carritoControlador::class, 'incrementar'])->name('carrito.incrementar');
Route::post('/carrito/decrementar/{productoId}', [App\Http\Controllers\carritoControlador::class, 'decrementar'])->name('carrito.decrementar');

Route::post('pago', [App\Http\Controllers\carritoControlador::class, 'pago'])->name('pago');
Route::post('cobrar', [App\Http\Controllers\carritoControlador::class, 'cobrar'])->name('cobrar');
Route::get('pagos/estado/token/{token}/comprobante/{ern}', [App\Http\Controllers\carritoControlador::class, 'verificar'])->name('pagos.verificar');

Route::get('/pedidos', [App\Http\Controllers\comprasControlador::class, 'index'])->name('pedidos');
Route::put('/pedidos/{pedido_id}', [App\Http\Controllers\comprasControlador::class, 'update'])->name('pedidos.update');

Route::get('categorias', [App\Http\Controllers\categoriasControlador::class, 'index'])->name('categorias');
Route::post('categorias', [App\Http\Controllers\categoriasControlador::class, 'store'])->name('categorias.store');
Route::post('categorias/{categoria_id}', [App\Http\Controllers\categoriasControlador::class, 'update'])->name('categorias.update');
Route::delete('categorias/{categoria_id}', [App\Http\Controllers\categoriasControlador::class, 'destroy'])->name('categorias.destroy');
Route::get('/categorias/filtrar', [App\Http\Controllers\categoriasControlador::class, 'filtrar'])->name('categorias.filtrar');

Route::get('producto/{producto_id}', [App\Http\Controllers\productosControlador::class, 'show'])->name('producto');
Route::get('productos', [App\Http\Controllers\productosControlador::class, 'index'])->name('productos');
Route::post('productos', [App\Http\Controllers\productosControlador::class, 'store'])->name('productos.store');
Route::post('productos/{producto_id}', [App\Http\Controllers\productosControlador::class, 'update'])->name('productos.update');
Route::delete('productos/{producto_id}', [App\Http\Controllers\productosControlador::class, 'destroy'])->name('productos.destroy');

Route::get('promociones', [App\Http\Controllers\promoControlador::class, 'index'])->name('promo');
Route::post('promociones', [App\Http\Controllers\promoControlador::class, 'store'])->name('promo.store');
Route::post('promociones/{promocion_id}', [App\Http\Controllers\promoControlador::class, 'update'])->name('promo.update');
Route::delete('promociones/{promocion_id}', [App\Http\Controllers\promoControlador::class, 'destroy'])->name('promo.destroy');

Route::get('anuncios', [App\Http\Controllers\promoControlador::class, 'index'])->name('promo');
Route::post('anuncios', [App\Http\Controllers\promoControlador::class, 'store'])->name('promo.store');
Route::post('anuncios/{anuncio_id}', [App\Http\Controllers\promoControlador::class, 'update'])->name('promo.update');
Route::delete('anuncios/{anuncio_id}', [App\Http\Controllers\promoControlador::class, 'destroy'])->name('promo.destroy');