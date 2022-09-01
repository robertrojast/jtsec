<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Models\RolesModel;
use App\Models\UsuariosModel;
use App\Models\ActividadesModel;
use App\Models\UsuariosProyectosModel;
use App\Models\UsuariosActividadesModel;

class DListadosTest extends TestCase
{
    /**
     * Añade usuarios al proyecto 1 con diferentes roles.
     *
     * @return void
     */
    public function test_listado_participantes_proyecto_1()
    {
        $response            = $this->get(route('listado-participantes-proyecto', [ 'id_proyecto' => 1 ]));
        $participantes       = $response->decodeResponseJson();
        $total_participantes = count($participantes);

        // Comprobamos que la url se resuelve correctamente
        $response->assertStatus(200);

        // START - COMPROBAMOS QUE SOLO HAYAN DOS USUARIOS "PARTICIPANTES" AL PROYECTO 1
        if($total_participantes==2) {
            $this->assertTrue(TRUE);
        }
        else {
            $this->assertTrue(FALSE);
        }
        // END - COMPROBAMOS QUE SOLO HAYAN DOS USUARIOS "PARTICIPANTES" AL PROYECTO 1
    }

    /**
     * Lista las actividades de un usuario con rol "participante" dentro del proyecto de la misma.
     *
     * @return void
     */
    public function test_listado_actividades_usuario_participante_en_proyecto()
    {
        $response          = $this->get(route('listado-actividades', [ 'id_usuario' => UsuariosModel::ID_USER_PARTICIPANTE ]));
        $actividades       = $response->decodeResponseJson();
        $total_actividades = count($actividades);

        // Comprobamos que la url se resuelve correctamente
        $response->assertStatus(200);

        // START - COMPROBAMOS QUE EL USUARIO PUEDA VER SUS ACTIVIDADES
        if($total_actividades>0) {
            $this->assertTrue(TRUE);
        }
        else {
            $this->assertTrue(FALSE);
        }
        // END - COMPROBAMOS QUE EL USUARIO PUEDA VER SUS ACTIVIDADES
    }

    /**
     * Intento de un usuario no "participante" en el proyecto de las actividades del mismo.
     *
     * @return void
     */
    public function test_listado_actividades_usuario_no_participante_en_proyecto()
    {
        $response          = $this->get(route('listado-actividades', [ 'id_usuario' => UsuariosModel::ID_USER_RESPONSABLE ]));
        $actividades       = $response->decodeResponseJson();
        $total_actividades = count($actividades);

        // Comprobamos que la url se resuelve correctamente
        $response->assertStatus(200);

        // START - COMPROBAMOS QUE EL USUARIO PUEDA VER SUS ACTIVIDADES
        if(!$total_actividades) {
            $this->assertTrue(TRUE);
        }
        else {
            $this->assertTrue(FALSE);
        }
        // END - COMPROBAMOS QUE EL USUARIO PUEDA VER SUS ACTIVIDADES
    }

    /**
     * Listado de incidencias de un usuario "responsable" de la actividad .
     *
     * @return void
     */
    public function test_listado_incidencias_usuario_responsable_en_actividad()
    {
        $response = $this->get(route('listado-incidencias', [
            'id_usuario'   => UsuariosModel::ID_USER_RESPONSABLE,
            'id_actividad' => UsuariosModel::ID_USER_RESPONSABLE,
        ]));

        $actividades       = $response->decodeResponseJson();
        $total_actividades = count($actividades);

        // Comprobamos que la url se resuelve correctamente
        $response->assertStatus(200);

        // START - COMPROBAMOS QUE EL USUARIO PUEDA VER SUS ACTIVIDADES
        if(!$total_actividades) {
            $this->assertTrue(TRUE);
        }
        else {
            $this->assertTrue(FALSE);
        }
        // END - COMPROBAMOS QUE EL USUARIO PUEDA VER SUS ACTIVIDADES
    }
}
