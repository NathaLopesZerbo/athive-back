<?php

namespace Padrao\Models\CadArquivo;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class CadArquivoService
{
    public function __construct(
        private CadArquivoRepository $repository
    ) {}

    public function index(string $uuid, array $filtros): LengthAwarePaginator
    {
        return $this->repository->getAll($uuid, $filtros);
    }

    public function show(string $uuid): CadArquivo
    {
        return $this->repository->getByUuid($uuid);
    }

    public function create(UploadedFile $arquivo, string $pasta): CadArquivo 
    {
        $nomeOriginal = $arquivo->getClientOriginalName();

        $nomeFisico = Str::uuid() . '.' . $arquivo->getClientOriginalExtension();

        $arquivo->move(public_path("uploads/{$pasta}"), $nomeFisico);

        $data = [
            'nome_original' => $nomeOriginal,
            'nome_fisico'   => $nomeFisico,
            'caminho'       => "/uploads/{$pasta}/{$nomeFisico}"
        ];

        return $this->repository->create($data);
    }

    public function update(string $uuid, array $data): bool
    {
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
}