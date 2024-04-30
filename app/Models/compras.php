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
        'descuento',
        'precio_real',
        'precio_total',
        'precio_neto',
        'comision_pagadito',
        'estado',
    ];

    public function detalles()
    {
        return $this->hasMany(detalleCompras::class, 'compra_id', 'compra_id');
    }
}
