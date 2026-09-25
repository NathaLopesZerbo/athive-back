<?php

namespace Padrao\Models\CadUnidade\Requests;

use Padrao\Base\PadraoRequest;

class CadUnidadeRequestFilter extends PadraoRequest
{
    public function rules()
    {
        return [
            'nome_unidade' => ['string', 'max:255']
        ];
    }
}
