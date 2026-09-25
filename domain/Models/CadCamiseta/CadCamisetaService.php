<?php

namespace Padrao\Models\CadCamiseta;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CadCamisetaService
{

   public function __construct(private CadCamisetaRepository $repository) {}

    public function index(array $filtros): LengthAwarePaginator
    {
        return $this->repository->getAll($filtros);
    }

    public function show(string $uuid): CadCamiseta
    {
        return $this->repository->getByUuid($uuid);
    }

    public function create(array $data): CadCamiseta 
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
