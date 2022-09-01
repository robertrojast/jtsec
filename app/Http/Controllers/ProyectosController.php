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

            return HelperResponse::JsonRequestStatus(TRUE, __('master.logOperationFinished'), __('master.logRegisterCreated'));
        }
        catch(QueryException $e) {
            return HelperResponse::JsonRequestStatus(FALSE, __('master.logOperationError'), $e->getMessage());
        }
        catch(Exception $e) {
            $errorMessage = $e->getFile()." (line ".$e->getLine()."): ".$e->getMessage();

            return HelperResponse::JsonRequestStatus(FALSE, __('master.logOperationError'), $errorMessage);
        }
    }

    /**
     * Obtiene el listado de participantes del proyecto especificado
     *
     * @param Int $id_proyecto
     * @return object
     */
    public static function ListadoParticipantesProyecto(Int $id_proyecto) : object {
        try{
            $participantes_proyecto = ProyectosRepository::ListadoParticipantesProyecto($id_proyecto);

            return HelperResponse::JsonRequestFromCollection($participantes_proyecto);
        }
        catch(QueryException $e) {
            return HelperResponse::JsonRequestStatus(FALSE, __('master.logOperationError'), $e->getMessage());
        }
        catch(Exception $e) {
            $errorMessage = $e->getFile()." (line ".$e->getLine()."): ".$e->getMessage();

            return HelperResponse::JsonRequestStatus(FALSE, __('master.logOperationError'), $errorMessage);
        }
    }

}
