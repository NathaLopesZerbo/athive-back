<?php

namespace Padrao\Models\CadPersona\Requests;

use Illuminate\Validation\Rule;
use Padrao\Base\PadraoRequest;

class CadPersonaRequest extends PadraoRequest
{
    public function rules()
    {
        return [
            'dsc_persona' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('cad_persona', 'dsc_persona')->ignore($this->route('persona'), 'uuid')
            ],
        ];
    }
}
