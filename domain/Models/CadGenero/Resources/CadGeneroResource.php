<?php

namespace Padrao\Models\CadGenero\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadGeneroResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'       => $this->uuid,
            'dsc_genero' => $this->dsc_genero,
        ];
    }
}
