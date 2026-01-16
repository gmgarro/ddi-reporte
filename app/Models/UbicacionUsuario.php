<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UbicacionUsuario extends Model
{
    protected $table = 'ubicacion_usuario';

    protected $fillable = [
        'usuarioId',
        'horaActualizacion',
        'latitud',
        'longitud',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuarioId');
    }
}
