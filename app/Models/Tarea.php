<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'frecuencia',
        'dias_semana',
        'fecha_inicio',
        'fecha_fin',
        'puntoVentaId',
        'proyectoId',
        'activa',
    ];

    protected $casts = [
        'dias_semana' => 'array',
        'activa' => 'boolean',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function puntoVenta()
    {
        return $this->belongsTo(PuntoVenta::class, 'puntoVentaId');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyectoId');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'tarea_usuarios', 'tareaId', 'userId');
    }

    public function ocurrencias()
    {
        return $this->hasMany(TareaOcurrencia::class, 'tareaId');
    }
}
