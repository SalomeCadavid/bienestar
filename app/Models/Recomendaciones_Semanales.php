<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recomendaciones_Semanales extends Model
{
    protected $table = 'recomendaciones_semanales';

    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'semana',
        'recomendacion'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
