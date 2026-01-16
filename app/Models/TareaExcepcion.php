<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TareaExcepcion extends Model
{
    protected $table = 'tarea_excepciones';

    protected $fillable = [
        'tareaId',
        'fecha',
        'nombre_override',
        'descripcion_override',
        'cancelada',
    ];

    protected $casts = [
        'fecha' => 'date',
        'cancelada' => 'boolean',
    ];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tareaId');
    }
}
