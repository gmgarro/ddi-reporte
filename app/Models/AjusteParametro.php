<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AjusteParametro extends Model
{
     protected $table = 'ajuste_parametros';

    protected $fillable = [
        'nombre',
        'tipo',
        'primerValor',
        'segundoValor'
    ];

    public function MedicionReporte(){
        return $this->hasMany(MedicionReporte::class,'ajusteParametroId');
    }
}
