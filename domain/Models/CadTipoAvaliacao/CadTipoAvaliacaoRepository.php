<?php

namespace Padrao\Models\CadTipoAvaliacao;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CadTipoAvaliacaoRepository
{
    public function __construct(protected CadTipoAvaliacao $model) {}

    public function getAll(array $filtros): LengthAwarePaginator
    {
        $per_page           = $filtros['per_page'] ?? 10;
        $dsc_tipo_avaliacao = $filtros['dsc_tipo_avaliacao'] ?? null;

        return $this
            ->defaultQuery()
            ->when(isset($dsc_tipo_avaliacao), fn($query) => $query->where('dsc_tipo_avaliacao', 'like', "%$dsc_tipo_avaliacao%"))
            ->when(
                !isset($filtros['campo_ordenacao']) && !isset($filtros['tipo_ordenacao']),
                fn($query) => $query->orderBy('dsc_tipo_avaliacao'),
                fn($query) => $query->orderBy($filtros['campo_ordenacao'], $filtros['tipo_ordenacao'])
            )
            ->paginate($per_page);
    }

    public function create(array $data): CadTipoAvaliacao
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

    public function getByUuid(string $uuid): CadTipoAvaliacao
    {
        return $this->model->findByUuid($uuid);
    }

    public function lookup(): Collection
    {
        return $this->model->select(
            'uuid',
            'dsc_tipo_avaliacao',
        )
        ->get();
    }

    private function defaultQuery(): Builder
    {
        return $this->model->select(
            'cad_tipo_avaliacao.*',
        );
    }
} 
