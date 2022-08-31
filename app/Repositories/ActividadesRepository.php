<?php

    namespace App\Repositories;

    use App\Repositories\Repository;

    use App\Models\ActividadesModel;

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
    }
