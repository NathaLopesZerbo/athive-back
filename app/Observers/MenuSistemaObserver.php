<?php

namespace App\Observers;

use Illuminate\Support\Str;
use Padrao\Models\CadMenuPermissao\CadMenuPermissao;
use Padrao\Models\MenuSistema\MenuSistema;

class MenuSistemaObserver
{
    public function created(MenuSistema $menu)
    {
        $this->createPermissions($menu);
    }

    private function createPermissions(MenuSistema $menu)
    {
        $perfis = ['ADMIN', 'PROFESSOR', 'ALUNO'];

        foreach ($perfis as $perfil) {

            $exists = CadMenuPermissao::where('id_menu', $menu->id_menu)
                ->where('perfil', $perfil)
                ->exists();

            if ($exists) {
                continue;
            }

            CadMenuPermissao::create([
                'uuid'       => Str::uuid(),
                'id_menu'    => $menu->id_menu,
                'perfil'     => $perfil,
                'can_view'   => $perfil === 'ADMIN',
                'can_create' => $perfil === 'ADMIN',
                'can_update' => $perfil === 'ADMIN',
                'can_delete' => $perfil === 'ADMIN',
            ]);
        }
    }
}