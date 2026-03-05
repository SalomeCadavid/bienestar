<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TipoProducto;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'precio',
        'categoria',
        'stock',
        'tipo_producto_id'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer'
    ];

    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'tipo_producto_id');
    }

    public function detalles()
    {
        return $this->hasMany(Detalle_Factura::class, 'producto_id');
    }
}
