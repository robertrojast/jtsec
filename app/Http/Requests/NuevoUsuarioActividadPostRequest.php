<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NuevoUsuarioActividadPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            FORM_FIELD_ID_USUARIO   => 'required',
            FORM_FIELD_ID_ACTIVIDAD => 'required',
            FORM_FIELD_ID_ROL       => 'required',
        ];
    }
}
