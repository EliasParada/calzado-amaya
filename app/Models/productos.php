<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'producto_id';
    public $timestamps = false;

    protected $fillable = [
        'categoria_id',
        'codigo',
        'nombre',
        'descripcion',
        'colores',
        'tallas',
        'imagenes',
        'precio_compra',
        'precio_venta',
        'existencia',
    ];

    public function categoria()
    {
        return $this->belongsTo(categorias::class, 'categoria_id', 'categoria_id');
    }

    public function detalles()
    {
        return $this->hasMany(detalleCompras::class, 'producto_id', 'producto_id');
    }

    public function descuento()
    {
        return $this->hasOne(promosiones::class, 'producto_id', 'producto_id');
    }
}
