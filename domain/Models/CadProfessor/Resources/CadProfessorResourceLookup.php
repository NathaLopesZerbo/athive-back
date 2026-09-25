<?php

namespace Padrao\Models\CadProfessor\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadProfessorResourceLookup extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'value' => $this->uuid,
            'label' => $this->usuario->nome_usuario,
        ];
    }
}
