<?php

namespace Padrao\Models\CadConsultaAnual;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CadConsultaAnualRepository
{
    public function __construct(protected CadConsultaAnual $model) {}

    public function getAll(string $uuid, array $filtros): LengthAwarePaginator
    {
        $per_page = $filtros['per_page'] ?? 10;

        return $this
            ->defaultQuery()
            ->whereRelation('aluno', 'uuid', $uuid)
            ->when(
                !isset($filtros['campo_ordenacao']) && !isset($filtros['tipo_ordenacao']),
                fn($query) => $query->orderBy('dsc_consulta'),
                fn($query) => $query->orderBy($filtros['campo_ordenacao'], $filtros['tipo_ordenacao'])
            )
            ->paginate($per_page);
    }

    public function create(array $data): CadConsultaAnual
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

    public function getByUuid(string $uuid): CadConsultaAnual
    {
        return $this->model->findByUuid($uuid);
    }

    public function lookup(): Collection
    {
        return $this->model->select(
            'uuid',
            'dsc_consulta',
        )
        ->get();
    }

    private function defaultQuery(): Builder
    {
        return $this->model->select(
            'cad_consulta_anual.*',
        );
    }
} 
