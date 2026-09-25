<?php

namespace Padrao\Models\CadUsuario\Filters;

use Illuminate\Database\Eloquent\Builder;

class CadUsuarioFilter
{
    public static function apply(
        Builder $query,
        array $filtros,
        string $relation = 'usuario'
    ): Builder {

        return $query
            ->when(isset($filtros['nome_usuario']),fn($query) => $query->whereRelation($relation,'nome_usuario','like',"%{$filtros['nome_usuario']}%"))
            ->when(isset($filtros['email']),fn($query) => $query->whereRelation($relation,'email','like',"%{$filtros['email']}%"))
            ->when(isset($filtros['ativo']),fn($query) => $query->whereRelation($relation,'ativo',$filtros['ativo']))
            ->when(isset($filtros['uuid_unidade']),fn($query) => $query->whereHas($relation.'.unidade', fn($q) => $q->where('uuid', $filtros['uuid_unidade'])));
    }
}