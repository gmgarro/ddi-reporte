<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'paisId'
    ];

    
    public function paise()
    {
        return $this->belongsTo(Paise::class, 'paisId');
    }

    public function puntosVenta()
    {
        return $this->hasMany(PuntoVenta::class, 'clienteId');
    }

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'clienteId');
    }
}
