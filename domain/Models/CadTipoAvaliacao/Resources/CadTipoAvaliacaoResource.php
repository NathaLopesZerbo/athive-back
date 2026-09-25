<?php

namespace Padrao\Models\CadTipoAvaliacao\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadTipoAvaliacaoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'               => $this->uuid,
            'dsc_tipo_avaliacao' => $this->dsc_tipo_avaliacao,
        ];
    }
}
