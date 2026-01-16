<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
     protected $table = 'herramientas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'proyectoId'
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyectoId');
    }
}
