<?php

namespace Padrao\Models\CadAvaliacaoAluno;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Padrao\Models\CadAluno\CadAlunoRepository;
use Padrao\Models\CadArquivo\CadArquivoService;
use Padrao\Models\CadTipoAvaliacao\CadTipoAvaliacaoRepository;

class CadAvaliacaoAlunoService
{

   public function __construct(
        private CadAvaliacaoAlunoRepository $repository,
        private CadArquivoService $arquivoService
    ) {}

    public function index(string $uuid, array $filtros): LengthAwarePaginator
    {
        return $this->repository->getAll($uuid, $filtros);
    }

    public function show(string $uuid): CadAvaliacaoAluno
    {
        return $this->repository->getByUuid($uuid);
    }

    public function create(array $data): CadAvaliacaoAluno
    {
        if (isset($data['arquivo'])) {
            $arquivo = $this->arquivoService->create($data['arquivo'], 'avaliacoes');

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
        $avaliacao = $this->repository->getByUuid($uuid);

        if ($avaliacao->arquivo) {
            $uuidArquivo = $avaliacao->arquivo->uuid;
        }

        $arquivo = $this->repository->delete($uuid);

        $this->arquivoService->delete($uuidArquivo);
        
        return $arquivo;
    }

    public function download(string $uuid): array
    {
        $avaliacao = $this->repository->getByUuid($uuid);

        return [
            'path' => public_path($avaliacao->arquivo->caminho),
            'nome' => $avaliacao->arquivo->nome_original,
        ];
    }

    public function lookup(): Collection
    {
        return $this->repository->lookup();
    } 

    public function setUuidToID(array $data): array
    {
        $alunoRepository         = app()->make(CadAlunoRepository::class);
        $tipoAvaliacaoRepository = app()->make(CadTipoAvaliacaoRepository::class);

        $data['id_aluno'] = $alunoRepository->getByUuid($data['uuid_aluno'])->id_aluno;

        $data['id_tipo_avaliacao'] = $tipoAvaliacaoRepository->getByUuid($data['uuid_tipo_avaliacao'])->id_tipo_avaliacao;

        return $data;
    }

}
