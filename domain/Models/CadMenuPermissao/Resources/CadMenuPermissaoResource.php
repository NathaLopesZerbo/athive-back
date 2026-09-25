<?php

namespace Padrao\Models\CadMenuPermissao\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CadMenuPermissaoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'uuid'        => $this->uuid,
            'perfil'      => $this->perfil,
            'uuid_menu'   => $this->menu?->uuid,
            'nome_menu'   => $this->menu?->nome_menu,
            'can_view'    => $this->can_view,
            'can_create'  => $this->can_create,
            'can_update'  => $this->can_update,
            'can_delete'  => $this->can_delete,
        ];
    }
}
