<?php

namespace Padrao\Models\CadTipoAvaliacao\Requests;

use Padrao\Base\PadraoRequest;
use Illuminate\Validation\Rule;

class CadTipoAvaliacaoRequest extends PadraoRequest
{
    public function rules()
    {
        return [
            'dsc_tipo_avaliacao' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('cad_tipo_avaliacao', 'dsc_tipo_avaliacao')->ignore($this->route('tipoAvaliacao'), 'uuid'),
            ],
        ];
    }
}
