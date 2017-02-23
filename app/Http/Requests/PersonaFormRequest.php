<?php

namespace crggWebsite\Http\Requests;

use crggWebsite\Http\Requests\Request;

class PersonaFormRequest extends Request
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
           // Esto lo que vamos a validadar desde el formulario
            'nombre'=>'required|max:100',
            'tipo_documento'=>'required|max:256',
            'num_documento'=>'required|max:15',
            'direccion'=>'max:70',
            'telefono'=>'max:50'                
        ];
    }
}
