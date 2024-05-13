<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compras extends Model
{
    use HasFactory;

    protected $table = 'compras';
    protected $primaryKey = 'compra_id';
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'factura_nombre',
        'fecha_compra',
        'fecha_retiro',
        'fecha_envio',
        'ubicacion_envio',
        'correo',
        'telefono',
        'nombres',
        'apellidos',
        'descuento',
        'precio_total', // Precio total sin envio
        'precio_envio', // Precio del envio
        'precio_neto', // Envio y total
        'comision_pagadito', // Comision por transacción en pagadito
        'estado',
        'detalles',
    ];

    public function detalle()
    {
        return $this->hasMany(detalleCompras::class, 'compra_id', 'compra_id');
    }
}
