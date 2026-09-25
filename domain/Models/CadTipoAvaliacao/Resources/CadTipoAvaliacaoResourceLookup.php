<?php

namespace Padrao\Models\CadTipoAvaliacao\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadTipoAvaliacaoResourceLookup extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'value' => $this->uuid,
            'label' => $this->dsc_tipo_avaliacao,
        ];
    }
}
