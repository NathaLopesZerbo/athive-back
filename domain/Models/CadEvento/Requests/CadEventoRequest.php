<?php

namespace Padrao\Models\CadEvento\Requests;

use Padrao\Base\PadraoRequest;

class CadEventoRequest extends PadraoRequest
{
    public function rules()
    {
        return [
            'titulo_evento' => ['required', 'string', 'max:255'],
            'dsc_evento'    => ['required', 'string'],
            'data_evento'   => ['required', 'date'],
            'hora_inicio'   => ['required', 'string', 'max:40'],
            'hora_fim'      => ['required', 'string', 'max:40'],
            'local_evento'  => ['required', 'string', 'max:255'],
        ];
    }
}
