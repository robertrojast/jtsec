<?php

    namespace App\Repositories;

    use App\Repositories\Repository;

    use Illuminate\Support\Facades\DB;
    use Illuminate\Database\Eloquent\Collection;

    use App\Models\ProyectosModel;
    use App\Models\UsuariosProyectosModel;
    use App\Models\RolesModel;

    class ProyectosRepository extends Repository {
        /**
         * Asigna un nuevo usuario al proyecto especificado con el rol correspondiente
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

                foreach($roles_ids AS $role_id) {
                    $usuario_rol_proyecto = UsuariosProyectosModel::where(UsuariosProyectosModel::FIELD_ID_PROYECTO, $id_proyecto)
                        ->where(UsuariosProyectosModel::FIELD_ID_USUARIO, $id_usuario)
                        ->where(UsuariosProyectosModel::FIELD_ID_ROL, $role_id)
                        ->first();

                    if(!$usuario_rol_proyecto) {
                        $usuario_rol_proyecto = new UsuariosProyectosModel();
                    }

                    $usuario_rol_proyecto->{ UsuariosProyectosModel::FIELD_ID_PROYECTO } = $id_proyecto;
                    $usuario_rol_proyecto->{ UsuariosProyectosModel::FIELD_ID_USUARIO }  = $id_usuario;
                    $usuario_rol_proyecto->{ UsuariosProyectosModel::FIELD_ID_ROL }      = $role_id;
                    $usuario_rol_proyecto->save();
                }
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
            $es_participante = UsuariosProyectosModel::where(UsuariosProyectosModel::FIELD_ID_PROYECTO, $id_proyecto)
                ->where(UsuariosProyectosModel::FIELD_ID_USUARIO, $id_usuario)
                ->where(UsuariosProyectosModel::FIELD_ID_ROL, RolesModel::ID_ROL_PARTICIPANTE)
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
