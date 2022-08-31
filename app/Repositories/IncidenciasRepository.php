<?php

    namespace App\Repositories;

    use App\Repositories\Repository;

    use App\Models\IncidenciasModel;

    class IncidenciasRepository extends Repository {

        /**
         * Asigna una nueva incidencia a la actividad especificada (si ya existe una con el mismo nombre, la actualiza)
         *
         * @param Object $request       Valores de los campos del formulario
         * @return Bool
         */
        public static function NuevaIncidencia(Object $request) : Bool {
            $data              = $request->all();
            $id_actividad      = $data[FORM_FIELD_ID_ACTIVIDAD];
            $nombre_incidencia = $data[FORM_FIELD_NOMBRE_INCIDENCIA];

            // Comprobamos si existe una incidencia con el mismo nombre
            $incidencia = IncidenciasModel::where(IncidenciasModel::FIELD_NOMBRE, $nombre_incidencia)->first();

            // START - Si no existe, la creamos
            if(!$incidencia) {
                $incidencia = new IncidenciasModel();
            }
            // END - Si no existe, la creamos

            // START - Insertamos la configuración de la incidencia
            $incidencia->{ IncidenciasModel::FIELD_ID_ACTIVIDAD } = $id_actividad;
            $incidencia->{ IncidenciasModel::FIELD_NOMBRE }       = $nombre_incidencia;
            // END - Insertamos la configuración de la incidencia

            return $incidencia->save();
        }
    }
