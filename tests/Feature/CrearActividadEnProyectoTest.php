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
    public function test_crear_actividad_en_proyecto_1()
    {
        $fecha_actual     = date('d-m-Y H:i', time());
        $nombre_actividad = 'ACTIVIDAD ('.$fecha_actual.')';

        $nueva_actividad = new ActividadesModel();
        $nueva_actividad->{ ActividadesModel::FIELD_NOMBRE }      = $nombre_actividad;
        $nueva_actividad->{ ActividadesModel::FIELD_ID_PROYECTO } = 1;
        $nueva_actividad->save();

        $nueva_actividad_id = $nueva_actividad->id;

        $this->assertDatabaseHas(TABLA_ACTIVIDADES, [
            ActividadesModel::FIELD_ID => $nueva_actividad_id,
        ]);
    }
}
