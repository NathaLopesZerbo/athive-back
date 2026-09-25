<?php

namespace Padrao\Models\CadPersona\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadPersonaResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'        => $this->uuid,
            'dsc_persona' => $this->dsc_persona,
        ];
    }
}
