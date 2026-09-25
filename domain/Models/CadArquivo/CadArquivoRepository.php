<?php

namespace Padrao\Models\CadArquivo;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CadArquivoRepository
{
    public function __construct(protected CadArquivo $model) {}

    public function getAll(string $uuid, array $filtros): LengthAwarePaginator
    {
        $per_page = $filtros['per_page'] ?? 10;

        return $this
            ->defaultQuery()
            ->when(
                !isset($filtros['campo_ordenacao']) && !isset($filtros['tipo_ordenacao']),
                fn($query) => $query->orderBy('nome_salvo'),
                fn($query) => $query->orderBy($filtros['campo_ordenacao'], $filtros['tipo_ordenacao'])
            )
            ->paginate($per_page);
    }

    public function create(array $data): CadArquivo
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

    public function getByUuid(string $uuid): CadArquivo
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
            'cad_arquivo.*',
        );
    }
} 
