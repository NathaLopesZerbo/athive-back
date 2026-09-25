<?php

namespace Padrao\Models\CadConsultaAnual\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadConsultaAnualResourceLookup extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'value' => $this->uuid,
            'label' => $this->dsc_genero,
        ];
    }
}
