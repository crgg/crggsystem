<?php

namespace crggWebsite\Http\Requests;

use crggWebsite\Http\Requests\Request;
 
class CategoriaFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //autorizado por la request
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
            'nombre'=>'required|max:50',
            'descripcion'=>'max:256' 
        ];
    }
}
