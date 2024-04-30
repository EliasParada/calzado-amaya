<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleCompras extends Model
{
    use HasFactory;

    protected $table = 'detalle_compras';
    protected $primaryKey = false;
    public $timestamps = false;

    protected $fillable = [
        'compra_id',
        'usuario_id',
        'cantidad',
        'descuento',
    ];

    public function compra()
    {
        return $this->belongsTo(compras::class, 'compra_id', 'compra_id');
    }
}
