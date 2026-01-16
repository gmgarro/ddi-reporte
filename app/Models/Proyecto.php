<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{

    protected $table = 'proyectos';

    protected $fillable = [
        'nombre',
        'comentario',
        'clienteId'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clienteId');
    }

    public function herramientas()
    {
        return $this->hasMany(Herramienta::class, 'proyectoId');
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'proyectoId');
    }

}
