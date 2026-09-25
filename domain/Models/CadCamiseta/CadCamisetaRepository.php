<?php

namespace Padrao\Models\CadCamiseta;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CadCamisetaRepository
{
    public function __construct(protected CadCamiseta $model) {}

    public function getAll(array $filtros): LengthAwarePaginator
    {
        $per_page     = $filtros['per_page'] ?? 10;
        $dsc_camiseta = $filtros['dsc_camiseta'] ?? null;
        $cor          = $filtros['cor'] ?? null;

        return $this
            ->defaultQuery()
            ->when(isset($dsc_camiseta), fn($query) => $query->where('dsc_camiseta', 'like', "%$dsc_camiseta%"))
            ->when(isset($cor), fn($query) => $query->where('cor', 'like', "%$cor%"))
            ->when(
                !isset($filtros['campo_ordenacao']) && !isset($filtros['tipo_ordenacao']),
                fn($query) => $query->orderBy('dsc_camiseta'),
                fn($query) => $query->orderBy($filtros['campo_ordenacao'], $filtros['tipo_ordenacao'])
            )
            ->paginate($per_page);
    }

    public function create(array $data): CadCamiseta
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

    public function getByUuid(string $uuid): CadCamiseta
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
            'cad_camiseta.*',
        );
    }
} 
