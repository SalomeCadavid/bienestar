<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'edad',
        'peso',
        'estatura',
        'genero',
        'imc',
        'rol_id'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'edad' => 'integer',
        'peso' => 'decimal:2',
        'estatura' => 'decimal:2',
        'imc' => 'decimal:2'
    ];

    public function role()
    {
        return $this->belongsTo(Roles::class, 'rol_id');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'usuario_id');
    }

    public function recomendaciones()
    {
        return $this->hasMany(Recomendaciones_Semanales::class, 'usuario_id');
    }
}
