<?php

namespace Padrao\Models\CadPersona\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadPersonaResourceLookup extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'value' => $this->uuid,
            'label' => $this->dsc_persona,
        ];
    }
}
