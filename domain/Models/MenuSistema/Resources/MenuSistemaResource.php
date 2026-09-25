<?php

namespace Padrao\Models\MenuSistema\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuSistemaResource extends JsonResource
{
    public function toArray($request): array
    {
        $permission = $this->permissoes->first();

        return [
            'uuid' => $this->uuid,
            'nome_menu' => $this->nome_menu,
            'nome_exibicao' => $this->nome_exibicao,
            'descricao_menu' => $this->descricao_menu,
            'icone_menu' => $this->icone_menu,
            'ordem_menu' => $this->ordem_menu,
            'ativo_menu' => $this->ativo_menu,
            'parent_id'  => $this->parent_id,
            'permissions'=> [
                'view'   => (bool) ($permission?->can_view),
                'create' => (bool) ($permission?->can_create ?? false),
                'update' => (bool) ($permission?->can_update ?? false),
                'delete' => (bool) ($permission?->can_delete ?? false),
            ],
            'children' => MenuSistemaResource::collection($this->children),
        ];
    }
}
