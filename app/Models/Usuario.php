<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol_id',
        'genero',
        'edad',
        'peso',
        'estatura',
        'imc'
    ];

    protected $hidden = [
        'password'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class,'rol_id');
    }
}