<?php

namespace Padrao\Models\CadAvaliacaoAluno\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadAvaliacaoAlunoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'                => $this->uuid,
            'uuid_aluno'          => $this->aluno?->uuid,
            'nome_aluno'          => $this->aluno?->usuario?->nome_usuario,
            'dsc_avaliacao_aluno' => $this->dsc_avaliacao_aluno,
            'uuid_tipo_avaliacao' => $this->tipoAvaliacao?->uuid,
            'dsc_tipo_avaliacao'  => $this->tipoAvaliacao?->dsc_tipo_avaliacao,
            'uuid_arquivo'        => $this->arquivo?->uuid,
            'nome_arquivo'        => $this->arquivo?->nome_original,
        ];
    }
}
