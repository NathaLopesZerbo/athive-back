<?php

namespace Padrao\Models\CadGenero\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadGeneroResourceLookup extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'value' => $this->uuid,
            'label' => $this->dsc_genero,
        ];
    }
}
