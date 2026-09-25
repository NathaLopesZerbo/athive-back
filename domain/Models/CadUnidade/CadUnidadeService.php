<?php

namespace Padrao\Models\CadUnidade;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CadUnidadeService
{

   public function __construct(private CadUnidadeRepository $repository) {}

    public function index(array $filtros): LengthAwarePaginator
    {
        return $this->repository->getAll($filtros);
    }

    public function show(string $uuid): CadUnidade
    {
        return $this->repository->getByUuid($uuid);
    }

    public function create(array $data): CadUnidade 
    {
        $data = $this->setUuidToID($data);

        return $this->repository->create($data);
    }

    public function update(string $uuid, array $data): bool
    {
        $data = $this->setUuidToId($data);

        return $this->repository->update($uuid, $data);
    }

    public function delete(string $uuid): bool
    {
        return $this->repository->delete($uuid);
    }

    public function lookup(): Collection
    {
        return $this->repository->lookup();
    } 

    public function setUuidToID(array $data): array
    {
        return $data;
    }

}
