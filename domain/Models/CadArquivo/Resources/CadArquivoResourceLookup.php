<?php

namespace Padrao\Models\CadArquivo\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadArquivoResourceLookup extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'value' => $this->uuid,
            'label' => $this->cor,
        ];
    }
}
