<?php

namespace Padrao\Models\CadEvento\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadEventoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'          => $this->uuid,
            'uuid_arquivo'  => $this->arquivo?->uuid,
            'nome_original' => $this->arquivo?->nome_original,
            'nome_fisico'   => $this->arquivo?->nome_fisico,
            'titulo_evento' => $this->titulo_evento,
            'dsc_evento'    => $this->dsc_evento,
            'data_evento'   => convertDate($this->data_evento),
            'hora_inicio'   => $this->hora_inicio,
            'hora_fim'      => $this->hora_fim,
            'local_evento'  => $this->local_evento,
        ];
    }
}
