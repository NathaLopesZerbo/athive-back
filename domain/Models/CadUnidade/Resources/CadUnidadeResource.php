<?php

namespace Padrao\Models\CadUnidade\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadUnidadeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'         => $this->uuid,
            'nome_unidade' => $this->nome_unidade,
        ];
    }
}
