<?php

namespace Padrao\Models\CadUsuario;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Padrao\Models\CadUnidade\CadUnidadeRepository;

class CadUsuarioService
{

   public function __construct(private CadUsuarioRepository $repository) {}

    public function index(array $filtros): LengthAwarePaginator
    {
        return $this->repository->getAll($filtros);
    }

    public function show(string $uuid): CadUsuario
    {
        return $this->repository->getByUuid($uuid);
    }

    public function create(array $data): CadUsuario
    {
        $data = $this->setUuidToID($data);

        $senhaTemporaria = Str::random(10);

        $data['senha'] = $senhaTemporaria;

        $usuario = $this->repository->create($data);

        $usuario->senha = CriptoSenha($usuario->id_usuario, $senhaTemporaria);

        $usuario->save();

        return $usuario;
    }

    public function update(string $uuid, array $data): bool
    {
        $data = $this->setUuidToID($data);

        return $this->repository->update($uuid, $data);
    }

    public function delete(string $uuid): bool
    {
        return DB::transaction(function () use ($uuid) {
            $usuario = $this->repository->getByUuid($uuid);

            $usuario->usuarioConvite()?->delete();

            return $this->repository->delete($uuid);
        });
    }

    public function setUuidToID(array $data): array
    {
        $unidadeRepository = app()->make(CadUnidadeRepository::class);

        $data['id_unidade'] = $unidadeRepository->getByUuid($data['uuid_unidade'])->id_unidade;

        return $data;
    }
}
