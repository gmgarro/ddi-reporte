<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\PuntoVentaController;
use App\Http\Controllers\Web\EncargadoPuntoVentaController;
use App\Http\Controllers\Web\ClienteController;
use App\Http\Controllers\Web\EquipoController;
use App\Http\Controllers\Web\TipoEquipoController;
use App\Http\Controllers\Web\AjusteParametroController;
use App\Http\Controllers\Web\ProyectoController;
use App\Http\Controllers\Web\TareaController;
use App\Http\Controllers\Web\CalendarioController;
use App\Http\Controllers\Web\TareaOcurrenciaController;
use App\Http\Controllers\Web\ReporteController;

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Rutas de autenticación web
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Rutas protegidas (ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:1'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('clientes', ClienteController::class);

    // Clientes → Puntos de venta
    Route::resource('clientes.puntos-venta', PuntoVentaController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->parameters([
            'puntos-venta' => 'puntoVenta',
        ]);

    // Puntos de venta → Encargados
    Route::resource('puntos-venta.encargados', EncargadoPuntoVentaController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->parameters([
            'puntos-venta' => 'puntoVenta',
            'encargados' => 'encargadoPuntoVenta',
        ]);

    Route::resource('clientes.proyectos', ProyectoController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->parameters([
            'proyectos' => 'proyecto',
        ]);

    Route::resource('equipos', EquipoController::class)->except(['create', 'edit', 'show']);
    Route::resource('tipo-equipos', TipoEquipoController::class)->only(['store', 'destroy']);
    Route::resource('ajuste_parametros', AjusteParametroController::class);

    Route::delete(
        'herramientas/{herramienta}',
        [ProyectoController::class, 'destroyHerramienta']
    )->name('herramientas.destroy');

    Route::resource('tipo-equipos', TipoEquipoController::class)->only(['create', 'store']);


    Route::get('/calendario', [CalendarioController::class, 'calendario'])
        ->name('tareas.calendario');


    Route::get('/calendario/data', [CalendarioController::class, 'calendarioData'])
        ->name('tareas.calendario.data');

    Route::get(
        '/puntos-venta/{puntoVenta}/calendario',
        [CalendarioController::class, 'calendarioByPuntoServicio']
    )->name('puntos-venta.calendario');

    Route::get(
        '/puntos-venta/{puntoVenta}/calendario/data',
        [CalendarioController::class, 'calendarioDataByPuntoServicio']
    )->name('puntos-venta.calendario.data');


    Route::prefix('ocurrencias')->group(function () {
        Route::get('{ocurrencia}/edit', [TareaOcurrenciaController::class, 'edit'])
            ->name('ocurrencias.edit');

        Route::put('{ocurrencia}', [TareaOcurrenciaController::class, 'update'])
            ->name('ocurrencias.update');
    });


    Route::post('/tareas', [TareaController::class, 'store'])
        ->name('tareas.store');

    Route::put('/tareas/{tarea}', [TareaController::class, 'update'])
        ->name('tareas.update');

    Route::resource('puntos-venta.tareas', TareaController::class)
        ->only(['index', 'create', 'edit', 'destroy'])->parameters([
            'puntos-venta' => 'puntoVenta',
            'tareas' => 'tarea',
        ]);



    Route::post('/reportes', [ReporteController::class, 'store'])
        ->name('reportes.store');

    Route::resource('puntos-venta.reportes', ReporteController::class)
        ->only(['index', 'create'])->parameters([
            'puntos-venta' => 'puntoVenta',
            'reportes' => 'reporte',
        ]);

    Route::get('/reportes/{id}/pdf', [ReporteController::class, 'pdf'])->name('reportes.pdf');
    Route::get('/reporte/{id}/show', [ReporteController::class, 'show'])->name('reportes.show');

    Route::get('/puntos-venta/{punto}/excel-mediciones',
    [ReporteController::class, 'excelMediciones']
)->name('puntos-venta.excel');
});
