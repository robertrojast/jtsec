<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Models\RolesModel;
use App\Models\UsuariosModel;
use App\Models\UsuariosProyectosModel;

class AsignacionUsuariosTest extends TestCase
{
    /**
     * Añade nuevas incidencias a la última actividad creada
     *
     * @return void
     */
    public function test_asignacion_usuarios_a_proyecto_1()
    {
        $postFormUrl = route('nuevo-usuario-proyecto');

        // Obtenemos el listado de usuarios creados
        $usuarios = UsuariosModel::get();

        // START - ASIGNAMOS CADA USUARIO AL PROYECTO 1
        foreach($usuarios AS $usuario) {
            $id_usuario = $usuario->{ UsuariosModel::FIELD_ID };

            switch ($id_usuario) {
                case UsuariosModel::ID_USER_RESPONSABLE:
                    $roles_usuarios = [ RolesModel::ID_ROL_RESPONSABLE ];

                    break;
                case UsuariosModel::ID_USER_PARTICIPANTE:
                    $roles_usuarios = [ RolesModel::ID_ROL_PARTICIPANTE ];

                    break;
                default:
                    $roles_usuarios = [ RolesModel::ID_ROL_PARTICIPANTE, RolesModel::ID_ROL_RESPONSABLE ];

                    break;
            }

            $this->call('POST', $postFormUrl, [
                FORM_FIELD_ID_PROYECTO => 1,
                FORM_FIELD_ID_USUARIO  => $id_usuario,
                FORM_FIELD_IDS_ROLES   => $roles_usuarios,
                '_token'               => csrf_token()
            ]);

            // Comprobamos que se hayan asignado los usuarios al proyecto 1.
            $this->assertDatabaseHas(TABLA_USUARIOS_PROYECTOS, [
                UsuariosProyectosModel::FIELD_ID_USUARIO  => $id_usuario,
                UsuariosProyectosModel::FIELD_ID_PROYECTO => 1,
            ]);
        }
        // END - ASIGNAMOS CADA USUARIO AL PROYECTO 1
    }
}
