<?php

namespace Padrao\Models\CadCamiseta\Requests;

use Illuminate\Validation\Rule;
use Padrao\Base\PadraoRequest;

class CadCamisetaRequest extends PadraoRequest
{
    public function rules()
    {
        return [
            'dsc_camiseta' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('cad_camiseta', 'dsc_camiseta')->ignore($this->route('camiseta'), 'uuid')
            ],
        ];
    }
}
