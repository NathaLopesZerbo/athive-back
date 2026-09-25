<?php

namespace Padrao\Models\CadGenero\Requests;

use Padrao\Base\PadraoRequest;

class CadGeneroRequestFilter extends PadraoRequest
{
    public function rules()
    {
        return [
            'dsc_genero' => ['string', 'max:255'],
        ];
    }
}
