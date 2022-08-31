<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

use App\Helpers\HelperResponse;

use App\Repositories\ActividadesRepository;

class ActividadesController extends Controller {

    public function NuevaActividad(Int $id_proyecto) {
        try{
            $promotion_id = ActividadesRepository::nuevaActividad($request, $promotion_id);

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
