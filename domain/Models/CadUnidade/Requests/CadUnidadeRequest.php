<?php

namespace Padrao\Models\CadUnidade\Requests;

use Padrao\Base\PadraoRequest;
use Illuminate\Validation\Rule;

class CadUnidadeRequest extends PadraoRequest
{
    public function rules()
    {
        return [
            'nome_unidade' => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('cad_unidade', 'nome_unidade')->ignore($this->route('unidade'), 'uuid')
            ],
        ];
    }
}
