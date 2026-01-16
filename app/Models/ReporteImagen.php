<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporteImagen extends Model
{
    protected $table = 'reporte_imagenes';

    protected $fillable = [
        'reporteId',
        'imagenRuta',
    ];

    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'reporteId');
    }
}
