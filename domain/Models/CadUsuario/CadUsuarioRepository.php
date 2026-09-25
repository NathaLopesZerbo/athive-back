<?php

namespace Padrao\Models\CadUsuario;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class CadUsuarioRepository
{
    public function __construct(protected CadUsuario $model) {}

    public function getAll(array $filtros): LengthAwarePaginator
    {
        $per_page     = $filtros['per_page'] ?? 10;
        $nome_usuario = $filtros['nome_usuario'] ?? null;

        return $this
            ->defaultQuery()
            ->when($nome_usuario, fn($query) => $query->where('nome_usuario', 'like', "%$nome_usuario%"))
            ->when(
                !isset($filtros['campo_ordenacao']) && !isset($filtros['tipo_ordenacao']),
                fn($query) => $query->orderBy('id_usuario'),
                fn($query) => $query->orderBy($filtros['campo_ordenacao'], $filtros['tipo_ordenacao'])
            )
            ->paginate($per_page);
    }

    public function create(array $data): CadUsuario
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

    public function getByUuid(string $uuid): CadUsuario
    {
        return $this->model->findByUuid($uuid);
    }

    private function defaultQuery(): Builder
    {
        return $this->model->select(
            'cad_usuario.*',
        );
    }
}
