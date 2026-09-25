<?php

namespace Padrao\Models\CadPersona;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CadPersonaRepository
{
    public function __construct(protected CadPersona $model) {}

    public function getAll(array $filtros): LengthAwarePaginator
    {
        $per_page    = $filtros['per_page'] ?? 10;
        $dsc_persona = $filtros['dsc_persona'] ?? null;

        return $this
            ->defaultQuery()
            ->when(isset($dsc_persona), fn($query) => $query->where('dsc_persona', 'like', "%$dsc_persona%"))
            ->when(
                !isset($filtros['campo_ordenacao']) && !isset($filtros['tipo_ordenacao']),
                fn($query) => $query->orderBy('dsc_persona'),
                fn($query) => $query->orderBy($filtros['campo_ordenacao'], $filtros['tipo_ordenacao'])
            )
            ->paginate($per_page);
    }

    public function create(array $data): CadPersona
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

    public function getByUuid(string $uuid): CadPersona
    {
        return $this->model->findByUuid($uuid);
    }

    public function lookup(): Collection
    {
        return $this->model->select(
            'uuid',
            'dsc_persona'
        )
        ->get();
    }

    private function defaultQuery(): Builder
    {
        return $this->model->select(
            'cad_persona.*',
        );
    }
} 
