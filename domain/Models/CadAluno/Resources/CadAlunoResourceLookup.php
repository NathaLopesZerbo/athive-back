<?php

namespace Padrao\Models\CadAluno\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadAlunoResourceLookup extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'value' => $this->uuid,
            'label' => $this->usuario->nome_usuario,
        ];
    }
}
