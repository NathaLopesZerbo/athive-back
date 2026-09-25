<?php

namespace Padrao\Models\CadGenero;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CadGeneroRepository
{
    public function __construct(protected CadGenero $model) {}

    public function getAll(array $filtros): LengthAwarePaginator
    {
        $per_page   = $filtros['per_page'] ?? 10;
        $dsc_genero = $filtros['dsc_genero'] ?? null;

        return $this
            ->defaultQuery()
            ->when(isset($dsc_genero), fn($query) => $query->where('dsc_genero', 'like', "%$dsc_genero%"))
            ->when(
                !isset($filtros['campo_ordenacao']) && !isset($filtros['tipo_ordenacao']),
                fn($query) => $query->orderBy('dsc_genero'),
                fn($query) => $query->orderBy($filtros['campo_ordenacao'], $filtros['tipo_ordenacao'])
            )
            ->paginate($per_page);
    }

    public function create(array $data): CadGenero
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

    public function getByUuid(string $uuid): CadGenero
    {
        return $this->model->findByUuid($uuid);
    }

    public function lookup(): Collection
    {
        return $this->model->select(
            'uuid',
            'dsc_genero',
        )
        ->get();
    }

    private function defaultQuery(): Builder
    {
        return $this->model->select(
            'cad_genero.*',
        );
    }
} 
