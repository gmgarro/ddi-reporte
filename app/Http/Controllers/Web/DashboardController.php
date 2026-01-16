<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PuntoVenta;
use App\Models\User;
use App\Models\Cliente;
use App\Models\UbicacionUsuario;
class DashboardController extends Controller
{
    public function index()
    {
        // Traer todos los puntos de venta
        $puntosVenta = PuntoVenta::with('cliente', 'provincia')->get();


    $clientesRegistrados = Cliente::count();

    $empleadosConUbicacion = UbicacionUsuario::with('usuario')
        ->get();

        return view('dashboard.index', compact('puntosVenta', 'clientesRegistrados', 'empleadosConUbicacion'));
    }
}
