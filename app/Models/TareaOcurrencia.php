<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TareaOcurrencia extends Model
{
    protected $table = 'tarea_ocurrencias';

    protected $fillable = [
        'tareaId',
        'fecha',
        'estado',
        'inicio_real',
        'fin_real',
        'duracion_minutos',
    ];

    protected $casts = [
        'fecha' => 'date',
        'inicio_real' => 'datetime',
        'fin_real' => 'datetime',
    ];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tareaId');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'tarea_ocurrencia_usuarios', 'tareaOcurrenciaId', 'userId');
    }
}
