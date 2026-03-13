<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'password',
        'remember_token'
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
        return $this->hasMany(Factura::class);
    }

    public function recomendaciones()
    {
        return $this->hasMany(Recomendaciones_Semanales::class, 'usuario_id');
    }
}