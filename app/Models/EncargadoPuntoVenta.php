<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EncargadoPuntoVenta extends Model
{
    protected $table = 'encargados_punto_venta';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'puntoVentaId'
    ];

    public function puntoVenta()
    {
        return $this->belongsTo(PuntoVenta::class, 'puntoVentaId');
    }

}
