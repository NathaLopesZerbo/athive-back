<?php

namespace Padrao\Models\CadMenuPermissao;

use Illuminate\Database\Eloquent\Collection;
use Padrao\Models\MenuSistema\MenuSistemaRepository;

class CadMenuPermissaoService
{

   public function __construct(private CadMenuPermissaoRepository $repository) {}

    public function index(array $filtros): Collection
    {
        return $this->repository->getAll($filtros);
    }

    public function show(string $uuid): CadMenuPermissao
    {
        return $this->repository->getByUuid($uuid);
    }

    public function update(array $data)
    {
        $data = $this->setUuidToId($data);

        return $this->repository->update($data);
    }

    public function setUuidToID(array $data): array
    {
        $menuRepository = app()->make(MenuSistemaRepository::class);

        $data['id_menu'] = $menuRepository->getByUuid($data['uuid_menu'])->id_menu;

        return $data;
    }

}
