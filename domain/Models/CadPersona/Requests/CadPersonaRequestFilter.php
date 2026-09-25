<?php

namespace Padrao\Models\CadPersona\Requests;

use Padrao\Base\PadraoRequest;

class CadPersonaRequestFilter extends PadraoRequest
{
    public function rules()
    {
        return [
            'dsc_persona' => ['string', 'max:255']
        ];
    }
}
