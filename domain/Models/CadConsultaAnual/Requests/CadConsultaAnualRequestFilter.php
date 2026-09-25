<?php

namespace Padrao\Models\CadConsultaAnual\Requests;

use Padrao\Base\PadraoRequest;

class CadConsultaAnualRequestFilter extends PadraoRequest
{
    public function rules()
    {
        return [
            'dsc_consulta' => ['string', 'max:255'],
        ];
    }
}
