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

    /**
     * Obtiene el listado de todas las incidencias de la actividad especificada (si el usuario tiene rol "responsable" en la misma).
     *
     * @param Int $id_usuario
     * @param Int $id_actividad
     * @return object
     */
    public function ListadoIncidenciasUsuario(Int $id_usuario, Int $id_actividad) : object {
        try{
            $incidencias = IncidenciasRepository::ListadoIncidenciasUsuario($id_usuario, $id_actividad);

            return HelperResponse::JsonRequestFromCollection($incidencias);
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
