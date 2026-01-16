<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reportes';

    /**
     * Campos asignables
     */
    protected $fillable = [
        'contrato',
        'fecha',
        'tipoMantenimientoId',
        'descripcion',
        'marca',
        'modelo',
        'serie',
        'tipoPlanta',
        'checks',
        'horaInicial',
        'horaFinal',
        'referencia',
        'costoTotal',
        'recomendaciones',
        'observaciones',
        'puntoVentaId',
    ];

    protected $casts = [
        'fecha'        => 'date',
        'horaInicial'  => 'datetime',
        'horaFinal'    => 'datetime',
        'checks'       => 'array',
        'costoTotal'   => 'decimal:2',
    ];


    public function tipoMantenimiento()
    {
        return $this->belongsTo(
            TipoMantenimiento::class,
            'tipoMantenimientoId'
        );
    }


    public function puntoVenta()
    {
        return $this->belongsTo(
            PuntoVenta::class,
            'puntoVentaId'
        );
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'reporte_usuarios', 'reporteId', 'userId');
    }

    public function imagenes()
    {
        return $this->hasMany(ReporteImagen::class, 'reporteId');
    }

    public function firmas()
    {
        return $this->hasMany(ReporteFirma::class, 'reporteId');
    }

    public function mediciones()
    {
        return $this->hasMany(MedicionReporte::class,'reporteId');
    }
}
