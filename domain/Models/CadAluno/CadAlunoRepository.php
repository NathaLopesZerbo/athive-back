<?php

namespace Padrao\Models\CadAluno;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Padrao\Models\CadUsuario\Filters\CadUsuarioFilter;

class CadAlunoRepository
{
    public function __construct(protected CadAluno $model) {}

    public function getAll(array $filtros): LengthAwarePaginator
    {   
        $query = $this->defaultQuery();
        CadUsuarioFilter::apply($query, $filtros);
        
        $per_page       = $filtros['per_page'] ?? 10;
        $telefone       = $filtros['telefone'] ?? null;
        $uuid_camiseta  = $filtros['uuid_camiseta'] ?? null;
        $uuid_professor = $filtros['uuid_professor'] ?? null;
        
        return $query
            ->when(isset($uuid_camiseta), fn($query) => $query->whereRelation('camiseta', 'uuid', "$uuid_camiseta"))
            ->when(isset($telefone), fn($query) => $query->where('telefone', 'like', "%$telefone%"))
            ->when(isset($uuid_professor), fn($query) => $query->whereRelation('professor', 'uuid', "$uuid_professor"))
            ->when(
                !isset($filtros['campo_ordenacao']) && !isset($filtros['tipo_ordenacao']),
                fn($query) => $query->orderBy('id_aluno'),
                fn($query) => $query->orderBy($filtros['campo_ordenacao'], $filtros['tipo_ordenacao'])
            )
            ->paginate($per_page);
    }

    public function create(array $data): CadAluno
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

    public function getByUuid(string $uuid): CadAluno
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
            'cad_aluno.*',
        );
    }
} 
