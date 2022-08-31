<?php

    namespace App\Repositories;

    use App\Repositories\Repository;

    use App\Models\ActividadesModel;
    use App\Models\UsuariosActividadesModel;

    class ActividadesRepository extends Repository {

        /**
         * Asigna una nueva actividad al proyecto especificado (si ya existe una con el mismo nombre, la actualiza)
         *
         * @param Object $request       Valores de los campos del formulario
         * @return Bool
         */
        public static function NuevaActividad(Object $request) : Bool {
            $data             = $request->all();
            $id_proyecto      = $data[FORM_FIELD_ID_PROYECTO];
            $nombre_actividad = $data[FORM_FIELD_NOMBRE_ACTIVIDAD];

            // Comprobamos si existe una actividad con el mismo nombre
            $actividad = ActividadesModel::where(ActividadesModel::FIELD_NOMBRE, $nombre_actividad)->first();

            // START - Si no existe, la creamos
            if(!$actividad) {
                $actividad = new ActividadesModel();
            }
            // END - Si no existe, la creamos

            // START - Insertamos la configuración de la actividad
            $actividad->{ ActividadesModel::FIELD_ID_PROYECTO } = $id_proyecto;
            $actividad->{ ActividadesModel::FIELD_NOMBRE }      = $nombre_actividad;
            // END - Insertamos la configuración de la actividad

            return $actividad->save();
        }

        /**
         * Asigna un usuario a una actividad. Si ya está asignado, se actualiza su configuración.
         *
         * @param Object $request       Valores de los campos del formulario
         * @return Bool
         */
        public static function NuevoUsuarioActividad(Object $request) : Bool {
            $data         = $request->all();
            $id_usuario   = $data[FORM_FIELD_ID_USUARIO];
            $id_actividad = $data[FORM_FIELD_ID_ACTIVIDAD];
            $id_rol       = $data[FORM_FIELD_ID_ROL];

            // Comprobamos si el usuario ya está asignado a la actividad especificada
            $usuario_actividad = UsuariosActividadesModel::where(UsuariosActividadesModel::FIELD_ID_USUARIO, $id_usuario)
                ->where(UsuariosActividadesModel::FIELD_ID_ACTIVIDAD, $id_actividad)
                ->first();

            // START - Si no existe, lo creamos
            if(!$usuario_actividad) {
                $usuario_actividad = new UsuariosActividadesModel();
            }
            // END - Si no existe, lo creamos

            // START - Insertamos la configuración de la actividad
            $usuario_actividad->{ UsuariosActividadesModel::FIELD_ID_USUARIO }   = $id_usuario;
            $usuario_actividad->{ UsuariosActividadesModel::FIELD_ID_ACTIVIDAD } = $id_actividad;
            $usuario_actividad->{ UsuariosActividadesModel::FIELD_ID_ROL }       = $id_rol;
            // END - Insertamos la configuración de la actividad

            return $usuario_actividad->save();
        }
    }
