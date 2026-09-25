<?php

namespace Padrao\Models\MenuSistema;

use Illuminate\Support\Collection;

class MenuSistemaService
{
    public function __construct(private MenuSistemaRepository $repository) {}

    public function index(string $perfil): array
    {
        $menus = $this->repository->getByPerfil($perfil);

        return $this->buildTree($menus);
    }
    
    public function buildTree(Collection $menus): array
    {
        $tree  = [];
        $index = [];

        foreach ($menus as $menu) {
            $menu->children = collect();
            $index[$menu->id_menu] = $menu;
        }

        foreach ($menus as $menu) {
            if ($menu->parent_id && isset($index[$menu->parent_id])) {
                $index[$menu->parent_id]->children->push($menu);
            } else {
                $tree[] = $menu;
            }
        }

        return $tree;
    }
}
