<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Models\ActividadesModel;

class CrearActividadEnProyectoTest extends TestCase
{
    /**
     * Añade nuevas actividades al proyecto 1
     *
     * @return void
     */
    public function test_crear_actividad_en_proyecto_1() {
        $fecha_actual     = date('d-m-Y H:i', time());
        $nombre_actividad = 'ACTIVIDAD ('.$fecha_actual.')';
        $postFormUrl      = route('nueva-actividad');

        $this->call('POST', $postFormUrl, [
            FORM_FIELD_ID_PROYECTO      => 1,
            FORM_FIELD_NOMBRE_ACTIVIDAD => $nombre_actividad,
            '_token'                    => csrf_token()
        ]);

        $this->assertDatabaseHas(TABLA_ACTIVIDADES, [
            ActividadesModel::FIELD_NOMBRE => $nombre_actividad,
        ]);
    }
}
