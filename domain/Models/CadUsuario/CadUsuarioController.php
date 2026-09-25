<?php

namespace Padrao\Models\CadUsuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Padrao\Models\CadUsuario\Requests\CadUsuarioRequest;
use Padrao\Models\CadUsuario\Requests\CadUsuarioRequestFilter;
use Padrao\Models\CadUsuario\Resources\CadUsuarioResource;

class CadUsuarioController extends Controller
{
    public function __construct(protected CadUsuarioService $service) {}

    public function index(CadUsuarioRequestFilter $request): JsonResource
    {
        $row = $this->service->index($request->all());

        return CadUsuarioResource::collection($row);
    }

    public function show(string $uuid): JsonResource
    {
        $row = $this->service->show($uuid);

        return new CadUsuarioResource($row);
    }

    public function store(CadUsuarioRequest $request): JsonResource
    {
        $row = $this->service->create($request->all());

        return new CadUsuarioResource($row);
    }

    public function update(string $uuid, CadUsuarioRequest $request): Response
    {
        $this->service->update($uuid, $request->all());

        return response()->noContent();
    }

    public function destroy(string $uuid): Response
    {
        $this->service->delete($uuid);

        return response()->noContent();
    }
}
