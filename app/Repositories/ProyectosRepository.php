<?php

    namespace App\Repositories;

    use App\Repositories\Repository;

    use App\Models\UsuariosProyectosModel;

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
         * Asigna un nuevo usuario al proyecto especificado (si ya estaba asignado, no hace nada)
         *
         * @param object $request
         * @return Bool
         */
        public static function NuevoUsuarioProyecto(object $request) : Bool {
            $data        = $request->all();
            $id_proyecto = $data[FORM_FIELD_ID_PROYECTO];
            $id_usuario  = $data[FORM_FIELD_ID_USUARIO];

            // START - Si el usuario ya está asignado al proyecto
            if(self::usuarioAsignado($id_usuario, $id_proyecto)) {
                return TRUE;
            }
            // END - Si el usuario ya está asignado al proyecto

            // Añadimos el usuario al proyecto
            $usuario = new UsuariosProyectosModel();
            $usuario->{ UsuariosProyectosModel::FIELD_ID_PROYECTO } = $id_proyecto;
            $usuario->{ UsuariosProyectosModel::FIELD_ID_USUARIO }  = $id_usuario;

            return $usuario->save();
        }
    }
