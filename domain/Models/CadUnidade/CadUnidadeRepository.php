<?php

namespace Padrao\Models\CadUnidade;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CadUnidadeRepository
{
    public function __construct(protected CadUnidade $model) {}

    public function getAll(array $filtros): LengthAwarePaginator
    {
        $per_page    = $filtros['per_page'] ?? 10;
        $nome_unidade = $filtros['nome_unidade'] ?? null;

        return $this
            ->defaultQuery()
            ->when(isset($nome_unidade), fn($query) => $query->where('nome_unidade', 'like', "%$nome_unidade%"))
            ->when(
                !isset($filtros['campo_ordenacao']) && !isset($filtros['tipo_ordenacao']),
                fn($query) => $query->orderBy('nome_unidade'),
                fn($query) => $query->orderBy($filtros['campo_ordenacao'], $filtros['tipo_ordenacao'])
            )
            ->paginate($per_page);
    }

    public function create(array $data): CadUnidade
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

    public function getByUuid(string $uuid): CadUnidade
    {
        return $this->model->findByUuid($uuid);
    }

    public function lookup(): Collection
    {
        return $this->model->select(
            'uuid',
            'nome_unidade'
        )
        ->get();
    }

    private function defaultQuery(): Builder
    {
        return $this->model->select(
            'cad_unidade.*',
        );
    }
} 
