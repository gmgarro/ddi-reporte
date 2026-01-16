<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paise extends Model
{
    protected $table = 'paises';

    protected $fillable = ['nombre'];

    public function provincias()
    {
        return $this->hasMany(Provincia::class, 'paisId');
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'paisId');
    }
}
