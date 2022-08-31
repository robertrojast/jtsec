<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;

use App\Http\Requests\ProyectosPostRequest;

use App\Helpers\HelperResponse;

use App\Repositories\ProyectosRepository;

class ProyectosController extends Controller {

    /**
     * Asigna un usuario al proyecto especificado (vía POST)
     *
     * @param ProyectosPostRequest $request
     * @return object   Retorna un json con el estado de la operación.
     */
    public static function NuevoUsuarioProyecto(ProyectosPostRequest $request) : object {
        try{
            ProyectosRepository::NuevoUsuarioProyecto($request);

            return HelperResponse::returnJson(TRUE, __('master.logOperationFinished'), __('master.logRegisterCreated'));
        }
        catch(QueryException $e) {
            return HelperResponse::returnJson(FALSE, __('master.logOperationError'), $e->getMessage());
        }
        catch(Exception $e) {
            $errorMessage = $e->getFile()." (line ".$e->getLine()."): ".$e->getMessage();

            return HelperResponse::returnJson(FALSE, __('master.logOperationError'), $errorMessage);
        }
    }

    public static function ListadoParticipantes(Int $id_proyecto) {

    }

}
