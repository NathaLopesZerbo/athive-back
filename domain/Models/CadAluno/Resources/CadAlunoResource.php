<?php

namespace Padrao\Models\CadAluno\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Padrao\Models\CadUsuario\Resources\CadUsuarioResourceRelation;

class CadAlunoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'aluno'              => [
                'uuid'            => $this->uuid,
                'uuid_professor'  => $this->professor?->uuid,
                'dsc_professor'   => $this->professor?->usuario->nome_usuario,
                'uuid_camiseta'   => $this->camiseta?->uuid,
                'cor'             => $this->camiseta?->cor,
                'uuid_persona'    => $this->persona?->uuid,
                'dsc_persona'     => $this->persona?->dsc_persona,
                'uuid_genero'     => $this->genero?->uuid,
                'genero'          => $this->genero?->dsc_genero,
                'tam_camiseta'    => $this->tam_camiseta,
                'idade'           => $this->idade,
                'telefone'        => $this->telefone,
                'data_nascimento' => convertDate($this->data_nascimento),
                'data_inicio'     => convertDate($this->data_inicio)
            ],
            'usuario' => new CadUsuarioResourceRelation($this->usuario)
        ];
    }
}
