<?php

namespace Padrao\Models\CadAvaliacaoAluno\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadAvaliacaoAlunoResourceLookup extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'value' => $this->uuid,
            'label' => $this->cor,
        ];
    }
}
