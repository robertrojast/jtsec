<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Models\ActividadesModel;
use App\Models\IncidenciasModel;

class CrearIncidenciaEnUltimaActividadTest extends TestCase
{
    /**
     * Añade nuevas incidencias a la última actividad creada
     *
     * @return void
     */
    public function test_crear_incidencia_en_ultima_actividad()
    {
        // Obtenemos la última actividad creada
        $actividad    = ActividadesModel::orderBy(ActividadesModel::FIELD_ID, 'DESC')->first();
        $id_actividad = $actividad->{ ActividadesModel::FIELD_ID };

        $fecha_actual      = date('d-m-Y H:i', time());
        $nombre_incidencia = 'INCIDENCIA ('.$fecha_actual.')';
        $postFormUrl       = route('nueva-incidencia');

        $this->call('POST', $postFormUrl, [
            FORM_FIELD_ID_ACTIVIDAD      => $id_actividad,
            FORM_FIELD_NOMBRE_INCIDENCIA => $nombre_incidencia,
            '_token'                     => csrf_token()
        ]);

        $this->assertDatabaseHas(TABLA_INCIDENCIAS, [
            IncidenciasModel::FIELD_NOMBRE => $nombre_incidencia,
        ]);
    }
}
