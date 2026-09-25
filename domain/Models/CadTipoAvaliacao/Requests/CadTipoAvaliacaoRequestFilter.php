<?php

namespace Padrao\Models\CadTipoAvaliacao\Requests;

use Padrao\Base\PadraoRequest;

class CadTipoAvaliacaoRequestFilter extends PadraoRequest
{
    public function rules()
    {
        return [
            'dsc_tipo_avaliacao' => ['string', 'max:255'],
        ];
    }
}
