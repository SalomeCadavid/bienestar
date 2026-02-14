<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'factura';

    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'total',
        'fecha'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'fecha' => 'datetime'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function detalles()
    {
        return $this->hasMany(Detalle_Factura::class, 'factura_id');
    }
}
