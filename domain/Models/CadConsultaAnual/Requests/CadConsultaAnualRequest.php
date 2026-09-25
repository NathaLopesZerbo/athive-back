<?php

namespace Padrao\Models\CadConsultaAnual\Requests;

use Padrao\Base\PadraoRequest;
use Illuminate\Validation\Rule;

class CadConsultaAnualRequest extends PadraoRequest
{
    public function rules()
    {
        return [
            'dsc_consulta' => [
                'required', 'string', 'max:255', 
                Rule::unique('cad_consulta_anual', 'dsc_consulta')->ignore($this->route('consultaAnual'), 'uuid'),
            ],
        ];
    }
}
