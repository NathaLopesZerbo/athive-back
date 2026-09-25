<?php

namespace Padrao\Models\CadPersona;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Padrao\Models\CadPersona\Requests\CadPersonaRequest;
use Padrao\Models\CadPersona\Requests\CadPersonaRequestFilter;
use Padrao\Models\CadPersona\Resources\CadPersonaResource;
use Padrao\Models\CadPersona\Resources\CadPersonaResourceLookup;

class CadPersonaController extends Controller
{
    public function __construct(protected CadPersonaService $service) {}

    public function index(CadPersonaRequestFilter $request): JsonResource
    {
        $row = $this->service->index($request->all());

        return CadPersonaResource::collection($row);
    }

    public function show(string $uuid): JsonResource
    {
        $row = $this->service->show($uuid);

        return new CadPersonaResource($row);
    }

    public function store(CadPersonaRequest $request): JsonResource
    {
        $row = $this->service->create($request->all());

        return new CadPersonaResource($row);
    }

    public function update(string $uuid, CadPersonaRequest $request): Response
    {
        $this->service->update($uuid, $request->all());

        return response()->noContent();
    }

    public function destroy(string $uuid): Response
    {
        $this->service->delete($uuid);

        return response()->noContent();
    }

    public function lookup(): JsonResource
    {
        $rows = $this->service->lookup();

        return CadPersonaResourceLookup::collection($rows);
    }


}
