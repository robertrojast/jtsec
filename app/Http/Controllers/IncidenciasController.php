<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;

use App\Http\Requests\IncidenciasPostRequest;
use App\Http\Requests\NuevoUsuarioIncidenciaPostRequest;

use App\Helpers\HelperResponse;

use App\Repositories\IncidenciasRepository;

class IncidenciasController extends Controller {

    /**
     * Añade una incidencia a la actividad especificada (vía POST)
     *
     * @param IncidenciasPostRequest $request
     * @return object   Retorna un json con el estado de la operación.
     */
    public function NuevaIncidencia(IncidenciasPostRequest $request) : object {
        try{
            IncidenciasRepository::NuevaIncidencia($request);

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
     * Añade un usuario a una incidencia
     *
     * @param NuevoUsuarioIncidenciaPostRequest $request
     * @return object
     */
    public function NuevoUsuarioIncidencia(NuevoUsuarioIncidenciaPostRequest $request) : object {
        try{
            IncidenciasRepository::NuevoUsuarioIncidencia($request);

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

    public function ListadoIncidencias(Int $id_usuario) {

    }

}
