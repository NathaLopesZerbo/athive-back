<?php

namespace Padrao\Models\CadCamiseta\Requests;

use Padrao\Base\PadraoRequest;

class CadCamisetaRequestFilter extends PadraoRequest
{
    public function rules()
    {
        return [
            'dsc_camiseta' => ['string', 'max:255'],
            'cor'          => ['string', 'max:255'],
        ];
    }
}
