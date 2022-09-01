<?php

    namespace App\Helpers;

    use Illuminate\Database\Eloquent\Collection;

    class HelperResponse {

        /**
         * Nombres de los parámetros de retorno una vez ejecutado una request
         */
        const FORM_PARAM_STATUS         = 'success';
        const FORM_PARAM_STATUS_TITLE   = 'title';
        const FORM_PARAM_STATUS_MESSAGE = 'message';

        /**
         * Json de retorno de una request
         *
         * @param Bool $statusSuccess       Indica si la operación se ha realizado correctamente
         * @param String $statusTitle
         * @param String $statusMessage
         * @return object
         */
        public static function JsonRequestStatus(Bool $statusSuccess, String $statusTitle, String $statusMessage) : object {
            $json = response()->json([
                self::FORM_PARAM_STATUS         => $statusSuccess,
                self::FORM_PARAM_STATUS_TITLE   => $statusTitle,
                self::FORM_PARAM_STATUS_MESSAGE => $statusMessage
            ]);

            return $json;
        }

        /**
         * Devuelve una collectión como un json.
         *
         * @param Collection $collection
         * @return object
         */
        public static function JsonRequestFromCollection(Collection $collection) : object {
            $array = $collection->toArray();
            $json  = response()->json($array);

            return $json;
        }
    }
