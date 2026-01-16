<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'nombre',
        'primerApellido',
        'segundoApellido',
        'correo',
        'contrasena',
        'rolId'
    ];

    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    /**
     * Indicar a Laravel cuál es el campo de contraseña
     */
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'rolId');
    }

    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'usuarioId');
    }

    public function tareas()
    {
        return $this->belongsToMany(
            Tarea::class,
            'tarea_usuarios',
            'userId',
            'tareaId'
        );
    }

    public function ocurrencias()
    {
        return $this->belongsToMany(
            TareaOcurrencia::class,
            'tarea_ocurrencia_usuarios',
            'userId',
            'tareaOcurrenciaId'
        );
    }

    public function reportes()
    {
        return $this->belongsToMany(
            Reporte::class,
            'reporte_usuarios',
            'userId',
            'reporteId'
        );
    }

    public function ubicacion()
    {
        return $this->hasOne(UbicacionUsuario::class, 'usuarioId');
    }
}
