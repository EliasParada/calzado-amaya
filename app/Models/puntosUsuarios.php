<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class puntosUsuarios extends Model
{
    use HasFactory;

    protected $table = 'puntos_usuarios';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'puntos',
    ];

    public function usuario()
    {
        return $this->belongsTo(usuarios::class, 'usuario_id', 'usuario_id');
    }
}
