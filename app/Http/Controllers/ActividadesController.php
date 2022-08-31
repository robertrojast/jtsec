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
                return HelperResponse::returnJson(TRUE, __('master.logOperationFinished'), __('master.logRegisterCreated'));
            }
            else {
                return HelperResponse::returnJson(FALSE, __('master.logOperationError'), 'No se ha podido asignar el usuario a la actividad, ya que éste no es "participante" en el proyecto al que pertenece.');
            }
        }
        catch(QueryException $e) {
            return HelperResponse::returnJson(FALSE, __('master.logOperationError'), $e->getMessage());
        }
        catch(Exception $e) {
            $errorMessage = $e->getFile()." (line ".$e->getLine()."): ".$e->getMessage();

            return HelperResponse::returnJson(FALSE, __('master.logOperationError'), $errorMessage);
        }
    }

    public function ListadoActividades(Int $id_usuario) {

    }

}
