<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleCompras extends Model
{
    use HasFactory;

    protected $table = 'detalle_compras';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'compra_id',
        'producto_id',
        'cantidad',
        'descuento',
    ];

    public function compra()
    {
        return $this->belongsTo(compras::class, 'compra_id', 'compra_id');
    }

    public function productos()
    {
        return $this->belongsTo(productos::class, 'producto_id', 'producto_id');
    }
}
