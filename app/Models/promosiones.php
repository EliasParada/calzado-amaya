<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promosiones extends Model
{
    use HasFactory;

    protected $table = 'promociones';
    protected $primaryKey = 'promocion_id';
    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'descuento',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function productos()
    {
        return $this->belongsTo(productos::class, 'producto_id', 'producto_id');
    }
}
