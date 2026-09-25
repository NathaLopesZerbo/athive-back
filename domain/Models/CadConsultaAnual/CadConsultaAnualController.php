<?php

namespace Padrao\Models\CadConsultaAnual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Padrao\Models\CadConsultaAnual\Requests\CadConsultaAnualRequest;
use Padrao\Models\CadConsultaAnual\Requests\CadConsultaAnualRequestFilter;
use Padrao\Models\CadConsultaAnual\Resources\CadConsultaAnualResource;
use Padrao\Models\CadConsultaAnual\Resources\CadConsultaAnualResourceLookup;

class CadConsultaAnualController extends Controller
{
    public function __construct(protected CadConsultaAnualService $service) {}

    public function index(string $uuid, CadConsultaAnualRequestFilter $request): JsonResource
    {
        $row = $this->service->index($uuid, $request->all());

        return CadConsultaAnualResource::collection($row);
    }

    public function show(string $uuid_aluno, string $uuid): JsonResource
    {
        $row = $this->service->show($uuid);

        return new CadConsultaAnualResource($row);
    }

    public function store(string $uuid_aluno, CadConsultaAnualRequest $request): JsonResource
    {
        $row = $this->service->create($request->all());

        return new CadConsultaAnualResource($row);
    }

    public function update(string $uuid_aluno, string $uuid, CadConsultaAnualRequest $request): Response
    {
        $this->service->update($uuid, $request->all());

        return response()->noContent();
    }

    public function destroy(string $uuid_aluno, string $uuid): Response
    {
        $this->service->delete($uuid);

        return response()->noContent();
    }

    public function lookup(): JsonResource
    {
        $rows = $this->service->lookup();

        return CadConsultaAnualResourceLookup::collection($rows);
    }
}
