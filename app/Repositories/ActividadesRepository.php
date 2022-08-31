<?php

    namespace App\Repositories;

    use App\Repositories\Repository;

    use App\Models\ActividadesModel;

    class ActividadesRepository extends Repository {

        /**
         * Asigna una nueva activada al proyecto especificado
         *
         * @param Object $request       Valores de los campos del formulario
         * @param Int    $id_proyecto
         * @return Bool
         */
        public static function nuevaActividad(Object $request, Int $id_proyecto) : Bool {

        }
    }
