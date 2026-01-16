<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMantenimiento extends Model
{
    protected $table = 'tipos_mantenimientos';

    protected $fillable = ['nombre'];

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'tipoMantenimientoId');
    }
}
