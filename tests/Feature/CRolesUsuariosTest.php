<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Models\RolesModel;
use App\Models\UsuariosModel;
use App\Models\ActividadesModel;
use App\Models\IncidenciasModel;
use App\Models\UsuariosProyectosModel;
use App\Models\UsuariosActividadesModel;
use App\Models\UsuariosIncidenciasModel;

class CRolesUsuariosTest extends TestCase
{
    /**
     * Añade usuarios al proyecto 1 con diferentes roles.
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

    /**
     * Añade usuarios a la última actividad creada.
     *
     * @return void
     */
    public function test_asignacion_usuarios_a_ultima_actividad()
    {
        $postFormUrl = route('nuevo-usuario-actividad');

        // Obtenemos la última actividad creada
        $actividad    = ActividadesModel::orderBy(ActividadesModel::FIELD_ID, 'DESC')->first();
        $id_actividad = $actividad->{ ActividadesModel::FIELD_ID };

        // Obtenemos el listado de usuarios creados
        $usuarios = UsuariosModel::get();

        // START - ASIGNAMOS CADA USUARIO A LA ÚLTIMA ACTIVIDAD CREADA
        foreach($usuarios AS $usuario) {
            $id_usuario = $usuario->{ UsuariosModel::FIELD_ID };

            switch ($id_usuario) {
                case UsuariosModel::ID_USER_RESPONSABLE:
                    $id_rol = RolesModel::ID_ROL_RESPONSABLE;

                    break;
                case UsuariosModel::ID_USER_PARTICIPANTE:
                    $id_rol = RolesModel::ID_ROL_PARTICIPANTE;

                    break;
                default:
                    $id_rol = RolesModel::ID_ROL_RESPONSABLE;

                    break;
            }

            $this->call('POST', $postFormUrl, [
                FORM_FIELD_ID_USUARIO   => $id_usuario,
                FORM_FIELD_ID_ACTIVIDAD => $id_actividad,
                FORM_FIELD_ID_ROL       => $id_rol,
                '_token'                => csrf_token()
            ]);

            // START - SI EL USUARIO NO ES "PARTICIPANTE" DENTRO DEL PROYECTO, NO SE LE PUEDE ASIGNAR LA ACTIVIDAD
            if($id_usuario == UsuariosModel::ID_USER_RESPONSABLE) {
                $this->assertDatabaseMissing(TABLA_USUARIOS_ACTIVIDADES, [
                    UsuariosActividadesModel::FIELD_ID_USUARIO   => $id_usuario,
                    UsuariosActividadesModel::FIELD_ID_ACTIVIDAD => $id_actividad,
                ]);
            }
            // END - SI EL USUARIO NO ES "PARTICIPANTE" DENTRO DEL PROYECTO, NO SE LE PUEDE ASIGNAR LA ACTIVIDAD
            // START - SI EL USUARIO ES "PARTICIPANTE" DENTRO DEL PROYECTO, SE LE PUEDE ASIGNAR LA ACTIVIDAD
            else {
                $this->assertDatabaseHas(TABLA_USUARIOS_ACTIVIDADES, [
                    UsuariosActividadesModel::FIELD_ID_USUARIO   => $id_usuario,
                    UsuariosActividadesModel::FIELD_ID_ACTIVIDAD => $id_actividad,
                ]);
            }
            // END - SI EL USUARIO ES "PARTICIPANTE" DENTRO DEL PROYECTO, SE LE PUEDE ASIGNAR LA ACTIVIDAD
        }
        // END - ASIGNAMOS CADA USUARIO A LA ÚLTIMA ACTIVIDAD CREADA
    }

    /**
     * Añade usuarios a la última incidencia creada.
     *
     * @return void
     */
    public function test_asignacion_usuarios_a_ultima_incidencia()
    {
        $postFormUrl = route('nuevo-usuario-incidencia');

        // Obtenemos la última incidencia creada
        $incidencia    = IncidenciasModel::orderBy(IncidenciasModel::FIELD_ID, 'DESC')->first();
        $id_incidencia = $incidencia->{ IncidenciasModel::FIELD_ID };

        // Obtenemos el listado de usuarios creados
        $usuarios = UsuariosModel::get();

        // START - ASIGNAMOS TODOS LOS USUARIOS A LA INCIDENCIA
        foreach($usuarios AS $usuario) {
            $id_usuario = $usuario->{ UsuariosModel::FIELD_ID };

            $this->call('POST', $postFormUrl, [
                FORM_FIELD_ID_USUARIO    => $id_usuario,
                FORM_FIELD_ID_INCIDENCIA => $id_incidencia,
                '_token'                 => csrf_token()
            ]);

            // START - SI SE HA ASIGNADO LA INCIDENCIA AL USUARIO
            $this->assertDatabaseHas(TABLA_USUARIOS_INCIDENCIAS, [
                UsuariosIncidenciasModel::FIELD_ID_USUARIO    => $id_usuario,
                UsuariosIncidenciasModel::FIELD_ID_INCIDENCIA => $id_incidencia,
            ]);
            // END - SI SE HA ASIGNADO LA INCIDENCIA AL USUARIO
        }
        // END - ASIGNAMOS TODOS LOS USUARIOS A LA INCIDENCIA
    }
}
