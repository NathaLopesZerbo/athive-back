<?php

namespace Padrao\Models\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthLoginResource extends JsonResource {

    public function toArray($request): array
    {
        $data = [
            'uuid'         => $this->uuid,
            'uuid_unidade' => $this->unidade->uuid,
            'dsc_unidade'  => $this->unidade->nome_unidade,
            'usuario'      => $this->usuario,
            'sobrenome'    => $this->sobrenome,
            'nome_usuario' => $this->nome_usuario,
            'email'        => $this->email,
            'perfil'       => $this->perfil,
        ];

        if ($token = $this->getActiveToken()) {
            $data['token'] = $token;
        }

        return $data;
    }
}
