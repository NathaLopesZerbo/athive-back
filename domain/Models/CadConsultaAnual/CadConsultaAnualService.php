<?php

namespace Padrao\Models\CadConsultaAnual;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Padrao\Models\CadAluno\CadAlunoRepository;

class CadConsultaAnualService
{

   public function __construct(private CadConsultaAnualRepository $repository) {}

    public function index(string $uuid, array $filtros): LengthAwarePaginator
    {
        return $this->repository->getAll($uuid, $filtros);
    }

    public function show(string $uuid): CadConsultaAnual
    {
        return $this->repository->getByUuid($uuid);
    }

    public function create(array $data): CadConsultaAnual 
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
        $alunoRepository  = app()->make(CadAlunoRepository::class);
        
        $data['id_aluno'] = $alunoRepository->getByUuid($data['uuid_aluno'])->id_aluno;

        return $data;
    }
}
