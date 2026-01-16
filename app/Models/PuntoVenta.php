<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntoVenta extends Model
{
     protected $table = 'puntos_venta';

    protected $fillable = [
        'nombre',
        'latitud',
        'longitud',
        'clienteId',
        'provinciaId'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clienteId');
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provinciaId');
    }

    public function encargados()
    {
        return $this->hasMany(EncargadoPuntoVenta::class, 'puntoVentaId');
    }

    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'puntoVentaId');
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'puntoVentaId');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'puntoVentaId');
    }
}
