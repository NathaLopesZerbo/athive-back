<?php

namespace Padrao\Models\CadAvaliacaoAluno;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CadAvaliacaoAlunoRepository
{
    public function __construct(protected CadAvaliacaoAluno $model) {}

    public function getAll(string $uuid, array $filtros): LengthAwarePaginator
    {
        $uuid_tipo_avaliacao = $filtros['uuid_tipo_avaliacao'] ?? null;
        $per_page            = $filtros['per_page'] ?? 10;

        return $this
            ->defaultQuery()
            ->whereRelation('aluno', 'uuid', $uuid)
            ->when(isset($uuid_tipo_avaliacao), fn($query) => $query->whereRelation('tipoAvaliacao', 'uuid', "$uuid_tipo_avaliacao"))
            ->when(
                !isset($filtros['campo_ordenacao']) && !isset($filtros['tipo_ordenacao']),
                fn($query) => $query->orderBy('dsc_avaliacao_aluno'),
                fn($query) => $query->orderBy($filtros['campo_ordenacao'], $filtros['tipo_ordenacao'])
            )
            ->paginate($per_page);
    }

    public function create(array $data): CadAvaliacaoAluno
    {
        return $this->model->create($data);
    }

    public function update(string $uuid, array $data): bool
    {
        return $this->model->findByUuid($uuid)->update($data);
    }

    public function delete(string $uuid): bool
    {
        return $this->model->findByUuid($uuid)->delete();
    }

    public function getByUuid(string $uuid): CadAvaliacaoAluno
    {
        return $this->model->findByUuid($uuid);
    }

    public function lookup(): Collection
    {
        return $this->model->select(
            'uuid',
            'cor'
        )
        ->get();
    }

    private function defaultQuery(): Builder
    {
        return $this->model->select(
            'cad_avaliacao_aluno.*',
        );
    }
} 
