<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporteFirma extends Model
{
    protected $table = 'reporte_firma';

    protected $fillable = [
        'reporteId',
        'firmaRuta',
        'nombreFirmante',
        'cedulaFirmante',
        'firmadoEn',
        ];

    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'reporteId');
    }
}