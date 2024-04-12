<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class administradores extends Model
{
    use HasFactory;

    protected $table = 'administradores';
    protected $primaryKey = false;
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(usuarios::class, 'usuario_id', 'usuario_id');
    }
}
