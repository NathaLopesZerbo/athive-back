<?php

namespace Padrao\Models\CadGenero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Padrao\Models\CadGenero\Requests\CadGeneroRequest;
use Padrao\Models\CadGenero\Requests\CadGeneroRequestFilter;
use Padrao\Models\CadGenero\Resources\CadGeneroResource;
use Padrao\Models\CadGenero\Resources\CadGeneroResourceLookup;

class CadGeneroController extends Controller
{
    public function __construct(protected CadGeneroService $service) {}

    public function index(CadGeneroRequestFilter $request): JsonResource
    {
        $row = $this->service->index($request->all());

        return CadGeneroResource::collection($row);
    }

    public function show(string $uuid): JsonResource
    {
        $row = $this->service->show($uuid);

        return new CadGeneroResource($row);
    }

    public function store(CadGeneroRequest $request): JsonResource
    {
        $row = $this->service->create($request->all());

        return new CadGeneroResource($row);
    }

    public function update(string $uuid, CadGeneroRequest $request): Response
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

        return CadGeneroResourceLookup::collection($rows);
    }
}
