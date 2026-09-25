<?php

namespace Padrao\Models\CadUsuario\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadUsuarioResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'         => $this->uuid,
            'uuid_unidade' => $this->unidade->uuid,
            'nome_unidade' => $this->unidade->nome_unidade,
            'usuario'      => $this->usuario,
            'nome_usuario' => $this->nome_usuario,
            'sobrenome'    => $this->sobrenome,
            'email'        => $this->email,
            'ativo'        => $this->ativo,
        ];
    }
}
