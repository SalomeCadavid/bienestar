<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle_Factura extends Model
{
    protected $table = 'detalle_factura';

    public $timestamps = false;

    protected $fillable = [
        'factura_id',
        'producto_id',
        'cantidad',
        'precio_unitario'
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'precio_unitario' => 'decimal:2'
    ];

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
