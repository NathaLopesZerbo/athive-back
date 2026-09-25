<?php

namespace Padrao\Models\CadUsuarioConvite;

class CadUsuarioConviteRepository
{
    public function __construct(protected CadUsuarioConvite $model) {}

    public function create(array $data): CadUsuarioConvite
    {
        return $this->model->create($data);
    }
} 
