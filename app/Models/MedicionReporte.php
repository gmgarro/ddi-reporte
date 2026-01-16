<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicionReporte extends Model
{
    protected $table = 'mediciones_reporte';

    protected $fillable = [
        'medicionInicial',
        'medicionFinal',
        'reporteId',
        'ajusteParametroId',
    ];

    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'reporteId');
    }

    public function ajusteParametro()
    {
        return $this->belongsTo(AjusteParametro::class,'ajusteParametroId');
    }
}
