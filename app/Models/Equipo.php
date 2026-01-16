<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
     protected $table = 'equipos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'fechaCambio',
        'tipoEquipoId',
        'usuarioId',
        'puntoVentaId'
    ];

    public function tipo()
    {
        return $this->belongsTo(TipoEquipo::class, 'tipoEquipoId');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'usuarioId');
    }

    public function puntoVenta()
    {
        return $this->belongsTo(PuntoVenta::class, 'puntoVentaId');
    }
}
