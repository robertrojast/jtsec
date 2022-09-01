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

        $nueva_incidencia = new IncidenciasModel();
        $nueva_incidencia->{ IncidenciasModel::FIELD_ID_ACTIVIDAD } = $id_actividad;
        $nueva_incidencia->{ IncidenciasModel::FIELD_NOMBRE }       = $nombre_incidencia;
        $nueva_incidencia->save();

        $nueva_incidencia_id = $nueva_incidencia->id;

        $this->assertDatabaseHas(TABLA_INCIDENCIAS, [
            IncidenciasModel::FIELD_ID => $nueva_incidencia_id,
        ]);
    }
}
