<?php

namespace Padrao\Models\CadEvento;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Padrao\Models\CadArquivo\CadArquivoService;

class CadEventoService
{
   public function __construct(
        private CadEventoRepository $repository,
        private CadArquivoService $arquivoService
    ) {}

    public function index(array $filtros): LengthAwarePaginator
    {
        return $this->repository->getAll($filtros);
    }

    public function show(string $uuid): CadEvento
    {
        return $this->repository->getByUuid($uuid);
    }

    public function create(array $data): CadEvento
    {
        if (isset($data['arquivo'])) {
            $arquivo = $this->arquivoService->create($data['arquivo'], 'eventos');

            $data['id_arquivo'] = $arquivo->id_arquivo;
        }

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
        $evento = $this->repository->getByUuid($uuid);

        if ($evento->arquivo) {
            $uuidArquivo = $evento->arquivo->uuid;
        }

        $arquivo = $this->repository->delete($uuid);

        $this->arquivoService->delete($uuidArquivo);
        
        return $arquivo;
    }

    public function setUuidToID(array $data): array
    {
        return $data;
    }

}
