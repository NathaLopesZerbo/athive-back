<?php

namespace Padrao\Models\CadArquivo\Requests;

use Padrao\Base\PadraoRequest;

class CadArquivoRequest extends PadraoRequest
{
    public function rules()
    {
        return [
            'dsc_camiseta' => ['required', 'string', 'max:255', 'unique:cad_camiseta,dsc_camiseta'],
        ];
    }
}
