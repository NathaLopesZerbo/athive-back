<?php

namespace Padrao\Models\CadArquivo\Requests;

use Padrao\Base\PadraoRequest;

class CadArquivoRequestFilter extends PadraoRequest
{
    public function rules()
    {
        return [
            'dsc_camiseta' => ['string', 'max:255'],
            'cor'          => ['string', 'max:255'],
        ];
    }
}
