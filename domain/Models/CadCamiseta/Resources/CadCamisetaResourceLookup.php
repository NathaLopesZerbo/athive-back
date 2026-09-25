<?php

namespace Padrao\Models\CadCamiseta\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadCamisetaResourceLookup extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'value' => $this->uuid,
            'label' => $this->cor,
        ];
    }
}
