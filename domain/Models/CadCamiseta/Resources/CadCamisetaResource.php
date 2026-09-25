<?php

namespace Padrao\Models\CadCamiseta\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadCamisetaResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'         => $this->uuid,
            'dsc_camiseta' => $this->dsc_camiseta,
            'cor'          => $this->cor,
        ];
    }
}
