<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;

use App\Http\Requests\ActividadesPostRequest;

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

    public function ListadoActividades(Int $id_usuario) {

    }

}
