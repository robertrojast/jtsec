<?php

    namespace App\Repositories;

    use App\Repositories\Repository;

    use Illuminate\Support\Facades\DB;
    use Illuminate\Database\Eloquent\Collection;

    use App\Models\ProyectosModel;
    use App\Models\UsuariosProyectosModel;
    use App\Models\UsuariosProyectosRolesModel;
    use App\Models\RolesModel;

    class ProyectosRepository extends Repository {

        /**
         * Comprueba si el usuario especificado ya tiene asignado el proyecto en cuestión.
         *
         * @param Int $id_usuario
         * @param Int $id_proyecto
         * @return Bool
         */
        public static function usuarioAsignado(Int $id_usuario, Int $id_proyecto) : Bool {
            $usuario_asignado = UsuariosProyectosModel::where(UsuariosProyectosModel::FIELD_ID_USUARIO, $id_usuario)
                ->where(UsuariosProyectosModel::FIELD_ID_PROYECTO, $id_proyecto)
                ->count();

            return (Bool) $usuario_asignado;
        }

        /**
         * Quita todos los roles que tenga asignado el usuario en el proyecto
         *
         * @param Int $id_usuario
         * @param Int $id_proyecto
         * @return Bool
         */
        public static function quitarRolesProyectoUsuario(Int $id_usuario, Int $id_proyecto) : Bool {
            return UsuariosProyectosRolesModel::where(UsuariosProyectosRolesModel::FIELD_ID_USUARIO, $id_usuario)
                ->where(UsuariosProyectosRolesModel::FIELD_ID_PROYECTO, $id_proyecto)
                ->delete();
        }

        /**
         * Añade los roles que tenga el usuario dentro del proyecto especificado.
         *
         * @param Int $id_usuario
         * @param Int $id_proyecto
         * @param Array $roles_ids
         * @return Bool
         */
        public static function insertarRolesProyectoUsuario(Int $id_usuario, Int $id_proyecto, Array $roles_ids) : Bool {
            // Quitamos roles anteriores que tenga asignado el usuario en el proyecto.
            self::quitarRolesProyectoUsuario($id_usuario, $id_proyecto);

            foreach($roles_ids AS $id_rol) {
                $rol = new UsuariosProyectosRolesModel();

                $rol->{ UsuariosProyectosRolesModel::FIELD_ID_ROL }      = $id_rol;
                $rol->{ UsuariosProyectosRolesModel::FIELD_ID_USUARIO }  = $id_usuario;
                $rol->{ UsuariosProyectosRolesModel::FIELD_ID_PROYECTO } = $id_proyecto;

                $rol->save();
            }

            return TRUE;
        }

        /**
         * Asigna un nuevo usuario al proyecto especificado
         *
         * @param object $request
         * @return Bool
         */
        public static function NuevoUsuarioProyecto(object $request) : Bool {
            DB::transaction(function() use ($request) {
                $data        = $request->all();
                $id_proyecto = $data[FORM_FIELD_ID_PROYECTO];
                $id_usuario  = $data[FORM_FIELD_ID_USUARIO];
                $roles_ids   = $data[FORM_FIELD_IDS_ROLES];

                // START - Si el usuario NO está asignado al proyecto
                if(!self::usuarioAsignado($id_usuario, $id_proyecto)) {
                    // Añadimos el usuario al proyecto
                    $usuario = new UsuariosProyectosModel();
                    $usuario->{ UsuariosProyectosModel::FIELD_ID_PROYECTO } = $id_proyecto;
                    $usuario->{ UsuariosProyectosModel::FIELD_ID_USUARIO }  = $id_usuario;
                    $usuario->save();
                }
                // END - Si el usuario NO está asignado al proyecto

                // AÑADIMOS LOS ROLES DEL USUARIO AL PROYECTO
                self::insertarRolesProyectoUsuario($id_usuario, $id_proyecto, $roles_ids);
            });

            return TRUE;
        }

        /**
         * Comprueba si el usuario en cuestión tiene el rol "participante" asignado en el proyecto
         *
         * @param Int $id_usuario
         * @param Int $id_proyecto
         * @return Bool
         */
        public static function usuarioEsParticipanteEnProyecto(Int $id_usuario, Int $id_proyecto) : Bool {
            $es_participante = UsuariosProyectosRolesModel::where(UsuariosProyectosRolesModel::FIELD_ID_PROYECTO, $id_proyecto)
                ->where(UsuariosProyectosRolesModel::FIELD_ID_USUARIO, $id_usuario)
                ->where(UsuariosProyectosRolesModel::FIELD_ID_ROL, RolesModel::ID_ROL_PARTICIPANTE)
                ->count();

            return (Bool) $es_participante;
        }

        /**
         * Obtiene el listado de participantes del proyecto especificado
         *
         * @param Int $id_proyecto
         * @return Collection       Retorna los ids de los usuarios participantes.
         */
        public static function ListadoParticipantesProyecto(Int $id_proyecto) : Collection {
            $proyecto      = ProyectosModel::where(ProyectosModel::FIELD_ID, $id_proyecto)->first();
            $participantes = $proyecto->{ ProyectosModel::FIELD_PARTICIPANTES };

            return $participantes;
        }
    }
