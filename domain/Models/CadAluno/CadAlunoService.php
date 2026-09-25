<?php

namespace Padrao\Models\CadAluno;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Padrao\Models\CadCamiseta\CadCamisetaRepository;
use Padrao\Models\CadGenero\CadGeneroRepository;
use Padrao\Models\CadPersona\CadPersonaRepository;
use Padrao\Models\CadProfessor\CadProfessorRepository;
use Padrao\Models\CadUsuario\CadUsuarioRepository;
use Padrao\Models\CadUsuario\CadUsuarioService;
use Padrao\Models\CadUsuarioConvite\CadUsuarioConviteService;

class CadAlunoService
{

   public function __construct(
        private CadAlunoRepository $repository, 
        private CadUsuarioService $usuarioService,
        private CadUsuarioConviteService $conviteService
    ) {}

    public function index(array $filtros): LengthAwarePaginator
    {
        return $this->repository->getAll($filtros);
    }

    public function show(string $uuid): CadAluno
    {
        return $this->repository->getByUuid($uuid);
    }

    public function create(array $data): CadAluno
    {
        return DB::transaction(function () use ($data) {

            $usuario = $this->usuarioService->create($data['usuario']);

            $data['aluno'] = $this->setUuidToId($data['aluno']);

            $aluno = $this->repository->create($data['aluno'] + ['id_usuario' => $usuario->id_usuario]);

            $this->conviteService->create($usuario);

            return $aluno;
        });
    }

    public function update(string $uuid, array $data): bool
    {
        return DB::transaction(function () use ($uuid, $data) {

            $aluno = $this->repository->getByUuid($uuid);

            $data['aluno'] = $this->setUuidToId($data['aluno']);

            $this->usuarioService->update($aluno->usuario->uuid, $data['usuario']);

            return $this->repository->update($uuid, $data['aluno']);
        });
    }

    public function delete(string $uuid): bool
    {
        return DB::transaction(function () use ($uuid) {

            $aluno = $this->repository->getByUuid($uuid);

            $uuidUsuario = $aluno->usuario->uuid;

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
        $professorRepository = app()->make(CadProfessorRepository::class);
        $generoRepository    = app()->make(CadGeneroRepository::class);
        $camisetaRepository  = app()->make(CadCamisetaRepository::class);
        $personaRepository   = app()->make(CadPersonaRepository::class);

        $data['id_professor'] = $professorRepository->getByUuid($data['uuid_professor'])->id_professor;

        $data['id_genero'] = $generoRepository->getByUuid($data['uuid_genero'])->id_genero;

        $data['id_camiseta'] = $camisetaRepository->getByUuid($data['uuid_camiseta'])->id_camiseta;
        
        $data['id_persona'] = $personaRepository->getByUuid($data['uuid_persona'])->id_persona;

        return $data;
    }

}
