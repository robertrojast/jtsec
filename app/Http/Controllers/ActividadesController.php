<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;

use App\Http\Requests\ActividadesPostRequest;
use App\Http\Requests\NuevoUsuarioActividadPostRequest;

use App\Helpers\HelperResponse;

use App\Repositories\ActividadesRepository;

class ActividadesController extends Controller {

    /**
     * Crea una nueva actividad y se la asigna al proyecto especificado (vía POST).
     *
     * @param ActividadesPostRequest $request
     * @return object   Retorna un json con el estado de la operación.
     */
    public function NuevaActividad(ActividadesPostRequest $request) : object {
        try{
            ActividadesRepository::NuevaActividad($request);

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
     * Asigna un usuario a la actividad especificada. Si ya estaba asignado, se actualiza su configuración (vía POST)
     *
     * @param NuevoUsuarioActividadPostRequest $request
     * @return object   Retorna un json con el estado de la operación.
     */
    public static function NuevoUsuarioActividad(NuevoUsuarioActividadPostRequest $request) : object {
        try{
            $asignado = ActividadesRepository::NuevoUsuarioActividad($request);

            if($asignado) {
                return HelperResponse::JsonRequestStatus(TRUE, __('master.logOperationFinished'), __('master.logRegisterCreated'));
            }
            else {
                return HelperResponse::JsonRequestStatus(FALSE, __('master.logOperationError'), 'No se ha podido asignar el usuario a la actividad, ya que éste no es "participante" en el proyecto al que pertenece.');
            }
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
     * Obtiene el listado de actividades del usuario especificado.
     *
     * @param Int $id_usuario
     * @return object
     */
    public function ListadoActividades(Int $id_usuario) : object {
        try{
            $actividades_usuario = ActividadesRepository::ListadoActividadesUsuario($id_usuario);

            return HelperResponse::JsonRequestFromCollection($actividades_usuario);
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
