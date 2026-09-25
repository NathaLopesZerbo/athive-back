<?php

namespace Padrao\Models\CadProfessor;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Padrao\Models\CadUsuario\Filters\CadUsuarioFilter;

class CadProfessorRepository
{
    public function __construct(protected CadProfessor $model) {}

    public function getAll(array $filtros): LengthAwarePaginator
    {
        $query = $this->defaultQuery();
        CadUsuarioFilter::apply($query, $filtros);

        $per_page = $filtros['per_page'] ?? 10;
        

        return $query
            ->when(
                !isset($filtros['campo_ordenacao']) && !isset($filtros['tipo_ordenacao']),
                fn($query) => $query->orderBy('id_professor'),
                fn($query) => $query->orderBy($filtros['campo_ordenacao'], $filtros['tipo_ordenacao'])
            )
            ->paginate($per_page);
    }

    public function create(array $data): CadProfessor
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

    public function getByUuid(string $uuid): CadProfessor
    {
        return $this->model->findByUuid($uuid);
    }

    public function lookup(): Collection
    {
        return $this->model->select(
            'uuid',
            'id_usuario'
        )
        ->whereRelation('usuario', 'ativo', true)
        ->get();
    }

    private function defaultQuery(): Builder
    {
        return $this->model->select(
            'cad_professor.*',
        );
    }
} 
