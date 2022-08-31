<?php

    namespace App\Helpers;

    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Request;

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
        public static function returnJson(Bool $statusSuccess, String $statusTitle, String $statusMessage) : object {
            $json = response()->json([
                self::FORM_PARAM_STATUS         => $statusSuccess,
                self::FORM_PARAM_STATUS_TITLE   => $statusTitle,
                self::FORM_PARAM_STATUS_MESSAGE => $statusMessage
            ]);

            return $json;
        }

        /**
         * Redirecciona a la url anterior utilizada
         *
         * @param Bool $statusSuccess   Por defecto: FALSE.
         * @param String $statusTitle
         * @param String $statusMessage
         * @param Array $requestInput   Ej: $request->input(). Si se quiere volver atrás con los valores de formulario enviados anteriormente.
         * @return void
         */
        /* public static function backToPrevious(Bool $statusSuccess=FALSE, String $statusTitle='', String $statusMessage='', Array $requestInput = []) {
            $redirect = back()->with(HelperResponse::FORM_PARAM_STATUS, $statusSuccess);

            if($requestInput)   $redirect->withInput($requestInput);
            if($statusTitle)    $redirect->with(HelperResponse::FORM_PARAM_STATUS_TITLE, $statusTitle);
            if($statusMessage)  $redirect->with(HelperResponse::FORM_PARAM_STATUS_MESSAGE, $statusMessage);

            return $redirect;
        } */

        /**
         * Redirecciona a la url con alias especificado
         *
         * @param String $destinationUrlAlias
         * @param Bool   $statusSuccess   Por defecto: TRUE.
         * @param String $statusTitle
         * @param String $statusMessage
         * @param Array  $requestInput   Ej: $request->input(). Si se quiere volver atrás con los valores de formulario enviados anteriormente.
         * @param Array  $urlParams      Array utilizado por si la url en cuestión llevara algún parámetro dinámico.
         * @return void
         */
        /* public static function goTo(String $destinationUrlAlias, Bool $statusSuccess=TRUE, String $statusTitle='', String $statusMessage='', Array $requestInput = [], Array $urlParams = []) {
            $redirect = redirect()->route($destinationUrlAlias, $urlParams)->with(HelperResponse::FORM_PARAM_STATUS, $statusSuccess);

            if($statusTitle)    $redirect->with(HelperResponse::FORM_PARAM_STATUS_TITLE, $statusTitle);
            if($statusMessage)  $redirect->with(HelperResponse::FORM_PARAM_STATUS_MESSAGE, $statusMessage);
            if($requestInput)   $redirect->withInput($requestInput);

            return $redirect;
        } */

        /**
         * Muestra la página de error
         *
         * @return void
         */
        /* public static function errorPage() {
            abort(404);
        } */
    }
