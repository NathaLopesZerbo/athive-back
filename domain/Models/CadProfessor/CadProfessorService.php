<?php

namespace Padrao\Models\CadProfessor;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Padrao\Models\CadGenero\CadGeneroRepository;
use Padrao\Models\CadUsuario\CadUsuarioRepository;
use Padrao\Models\CadUsuario\CadUsuarioService;
use Padrao\Models\CadUsuarioConvite\CadUsuarioConviteService;

class CadProfessorService
{

   public function __construct(
        private CadProfessorRepository $repository, 
        private CadUsuarioService $usuarioService,
        private CadUsuarioConviteService $conviteService
    ) {}

    public function index(array $filtros): LengthAwarePaginator
    {
        return $this->repository->getAll($filtros);
    }

    public function show(string $uuid): CadProfessor
    {
        return $this->repository->getByUuid($uuid);
    }

    public function create(array $data): CadProfessor
    {
        return DB::transaction(function () use ($data) {

            $usuario = $this->usuarioService->create($data['usuario']);

            $data['professor'] = $this->setUuidToId($data['professor']);

            $professor = $this->repository->create($data['professor'] + ['id_usuario' => $usuario->id_usuario]);

            $this->conviteService->create($usuario);

            return $professor;
        });
    }

    public function update(string $uuid, array $data): bool
    {
        return DB::transaction(function () use ($uuid, $data) {

            $professor = $this->repository->getByUuid($uuid);

            $data['professor'] = $this->setUuidToId($data['professor']);

            $this->usuarioService->update($professor->usuario->uuid, $data['usuario']);

            return $this->repository->update($uuid, $data['professor']);
        });
    }

    public function delete(string $uuid): bool
    {
        return DB::transaction(function () use ($uuid) {

            $professor = $this->repository->getByUuid($uuid);

            $uuidUsuario = $professor->usuario->uuid;

            $this->repository->delete($uuid);

           return $this->usuarioService->delete($uuidUsuario);
        });
    }

    public function lookup(): Collection
    {
        return $this->repository->lookup();
    }
    
    public function setUuidToID(array $data): array
    {
        $generoRepository  = app()->make(CadGeneroRepository::class);

        $data['id_genero'] = $generoRepository->getByUuid($data['uuid_genero'])->id_genero;

        return $data;
    }
}
