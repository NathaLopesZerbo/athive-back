<?php

namespace Padrao\Models\CadProfessor\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Padrao\Models\CadUsuario\Resources\CadUsuarioResourceRelation;

class CadProfessorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'professor' => [
                'uuid'            => $this->uuid,
                'uuid_genero'     => $this->genero?->uuid,
                'genero'          => $this->genero?->dsc_genero,
                'idade'           => $this->idade,
                'telefone'        => $this->telefone,
                'data_nascimento' => convertDate($this->data_nascimento),
                'formacao'        => $this->formacao,
            ],
            'usuario'   => new CadUsuarioResourceRelation($this->usuario),
        ];
    }
}
