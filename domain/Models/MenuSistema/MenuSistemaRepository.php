<?php

namespace Padrao\Models\MenuSistema;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class MenuSistemaRepository
{
    public function __construct(protected MenuSistema $model) {}

    public function getByPerfil(string $perfil): Collection
    {
        return $this->model
            ->with(['permissoes' => fn ($query) => $query->where('perfil', $perfil)])
            ->whereHas('permissoes', fn ($query) => $query->where('perfil', $perfil)->where('can_view', true))
            ->where('ativo_menu', true)
            ->orderBy('ordem_menu')
            ->get();
    }
        
    public function getByUuid(string $uuid): MenuSistema
    {
        return $this->model->findByUuid($uuid);
    }

    private function defaultQuery(): Builder
    {
        return $this->model->select(
            'menu_sistema.*',
        );
    }
} 
