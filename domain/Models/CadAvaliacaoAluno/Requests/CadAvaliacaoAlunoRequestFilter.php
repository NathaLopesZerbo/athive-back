<?php

namespace Padrao\Models\CadAvaliacaoAluno\Requests;

use Padrao\Base\PadraoRequest;

class CadAvaliacaoAlunoRequestFilter extends PadraoRequest
{
    public function rules()
    {
        return [
            'dsc_camiseta' => ['string', 'max:255'],
            'cor'          => ['string', 'max:255'],
        ];
    }
}
