<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccesoCentroController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resources([
    //No pongo medicos como route resource porque voy a añadirle middlewares diferentes
    //'medicos' => MedicoController::class,

    //ASOCIO EL CRUD DE ESTAS ENTIDADES CON SUS CONTROLADORES
    'acceso_centros' => AccesoCentroController::class,
    //'cargos' => CargoController::class,
    //'profesions' => ProfesionController::class,
    //'personal_sanitarios' => PersonalSanitarioController::class,
]);
