<?php

namespace Padrao\Models\CadMenuPermissao;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CadMenuPermissaoRepository
{
    public function __construct(protected CadMenuPermissao $model) {}

    public function getAll(array $filtros): Collection
    {
        $uuid_menu = $filtros['uuid_menu'] ?? null;

        return $this
            ->defaultQuery()
            ->when(isset($uuid_menu), fn($query) => $query->whereRelation('menu', 'uuid', "$uuid_menu"))
            ->get();
    }

    public function update(array $data)
    {
        foreach ($data['permissao'] as $item) {
            $this->model
                ->where('uuid', $item['uuid'])
                ->update([
                    'perfil'     => $item['perfil'],
                    'can_view'   => $item['can_view'],
                    'can_create' => $item['can_create'],
                    'can_update' => $item['can_update'],
                    'can_delete' => $item['can_delete'],
                ]);
        }
    }
    
    public function getByUuid(string $uuid): CadMenuPermissao
    {
        return $this->model->findByUuid($uuid);
    }

    private function defaultQuery(): Builder
    {
        return $this->model->select(
            'cad_menu_permissao.*',
        )->where('perfil', '!=', auth()->user()->perfil);
    }
} 
