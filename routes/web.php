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

Route::post('nueva-actividad/{id_proyecto}', [ActividadesController::class, 'NuevaActividad'])->name('nueva-actividad');
Route::post('nueva-incidencia/{id_actividad}', [IncidenciasController::class, 'NuevaIncidencia'])->name('nueva-incidencia');

Route::get('listado-actividades/{id_usuario}', [ActividadesController::class, 'ListadoActividades'])->name('listado-actividades');
Route::get('listado-incidencias/{id_usuario}', [IncidenciasController::class, 'ListadoIncidencias'])->name('listado-incidencias');
Route::get('listado-participantes/{id_proyecto}', [ProyectosController::class, 'ListadoParticipantes'])->name('listado-participantes');