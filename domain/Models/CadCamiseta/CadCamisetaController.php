<?php

namespace Padrao\Models\CadCamiseta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Padrao\Models\CadCamiseta\Requests\CadCamisetaRequest;
use Padrao\Models\CadCamiseta\Requests\CadCamisetaRequestFilter;
use Padrao\Models\CadCamiseta\Resources\CadCamisetaResource;
use Padrao\Models\CadCamiseta\Resources\CadCamisetaResourceLookup;

class CadCamisetaController extends Controller
{
    public function __construct(protected CadCamisetaService $service) {}

    public function index(CadCamisetaRequestFilter $request): JsonResource
    {
        $row = $this->service->index($request->all());

        return CadCamisetaResource::collection($row);
    }

    public function show(string $uuid): JsonResource
    {
        $row = $this->service->show($uuid);

        return new CadCamisetaResource($row);
    }

    public function store(CadCamisetaRequest $request): JsonResource
    {
        $row = $this->service->create($request->all());

        return new CadCamisetaResource($row);
    }

    public function update(string $uuid, CadCamisetaRequest $request): Response
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

        return CadCamisetaResourceLookup::collection($rows);
    }

}
