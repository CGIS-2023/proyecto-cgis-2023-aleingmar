<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccesoController;
use App\Http\Controllers\SanitarioController;
use App\Http\Controllers\IncidenciaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//los middleware can asocian policies creo

require __DIR__.'/auth.php'; //esto creo que es como si importara las rutas de auth

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard'); //tengo que estar autentificado creo



Route::get('/', function () {
    return view('welcome');
});




//middleware->auth -->-> solo visibles para los que han iniciado sesion
Route::middleware(['auth'])->group(function () {
Route::resources([
    //No pongo medicos como route resource porque voy a añadirle middlewares diferentes
    //'medicos' => MedicoController::class,

    //ASOCIO EL CRUD DE ESTAS ENTIDADES CON SUS CONTROLADORES
    'accesos' => AccesoController::class,
    //'cargos' => CargoController::class,
    //'profesions' => ProfesionController::class,
    'sanitarios' => SanitarioController::class,
    'incidencias'=> IncidenciaController::class,
    
]);

    //PRUEBA-->funciona con esta URL y no con (/sanitarios/filtrar)--> sospecho que es pk las url tienen que tener unas caracteristicas
    //         no puedes poner lo que te de la gana--> esta es parecida a la del index normal


    Route::get('/sanitarios_filtrar', [SanitarioController::class, 'filtrar_prueba'])->name('sanitarios.filtrar');

    //
    Route::get('/incidencias/{incidencia}/aceptarIncidencia', [IncidenciaController::class, 'aceptarIncidencia'])->name('incidencias.showAceptar');
    Route::put('/incidencias/{incidencia}/aceptarIncidencia', [IncidenciaController::class, 'updateAceptar'])->name('incidencias.updateAceptar');

});



