<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anuncios extends Model
{
    use HasFactory;

    protected $table = 'anuncios';
    protected $primaryKey = 'anuncio_id';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'imagen',
        'fecha_inicio',
        'fecha_fin',
        'accion',
    ];
}
