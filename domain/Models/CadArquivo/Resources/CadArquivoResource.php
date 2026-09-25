<?php

namespace Padrao\Models\CadArquivo\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadArquivoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'       => $this->uuid,
            'nome_salvo' => $this->nome_salvo,
        ];
    }
}
