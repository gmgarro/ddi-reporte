<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'provincias';

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
        return $this->hasMany(PuntoVenta::class, 'provinciaId');
    }
}
