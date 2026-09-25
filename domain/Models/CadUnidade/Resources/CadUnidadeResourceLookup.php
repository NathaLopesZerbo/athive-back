<?php

namespace Padrao\Models\CadUnidade\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadUnidadeResourceLookup extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'value' => $this->uuid,
            'label' => $this->nome_unidade,
        ];
    }
}
