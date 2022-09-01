<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

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

Route::post('nueva-actividad', [ActividadesController::class, 'NuevaActividad'])->name('nueva-actividad');
Route::post('nueva-incidencia', [IncidenciasController::class, 'NuevaIncidencia'])->name('nueva-incidencia');

Route::post('nuevo-usuario-proyecto', [ProyectosController::class, 'NuevoUsuarioProyecto'])->name('nuevo-usuario-proyecto');
Route::post('nuevo-usuario-actividad', [ActividadesController::class, 'NuevoUsuarioActividad'])->name('nuevo-usuario-actividad');
Route::post('nuevo-usuario-incidencia', [IncidenciasController::class, 'NuevoUsuarioIncidencia'])->name('nuevo-usuario-incidencia');

Route::get('listado-actividades/{id_usuario}', [ActividadesController::class, 'ListadoActividades'])->name('listado-actividades');
Route::get('listado-incidencias-usuario/{id_usuario}/{id_actividad}', [IncidenciasController::class, 'ListadoIncidenciasUsuario'])->name('listado-incidencias');
Route::get('listado-participantes-proyecto/{id_proyecto}', [ProyectosController::class, 'ListadoParticipantesProyecto'])->name('listado-participantes-proyecto');