<?php

namespace Padrao\Models\CadUnidade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Padrao\Models\CadUnidade\Requests\CadUnidadeRequest;
use Padrao\Models\CadUnidade\Requests\CadUnidadeRequestFilter;
use Padrao\Models\CadUnidade\Resources\CadUnidadeResource;
use Padrao\Models\CadUnidade\Resources\CadUnidadeResourceLookup;

class CadUnidadeController extends Controller
{
    public function __construct(protected CadUnidadeService $service) {}

    public function index(CadUnidadeRequestFilter $request): JsonResource
    {
        $row = $this->service->index($request->all());

        return CadUnidadeResource::collection($row);
    }

    public function show(string $uuid): JsonResource
    {
        $row = $this->service->show($uuid);

        return new CadUnidadeResource($row);
    }

    public function store(CadUnidadeRequest $request): JsonResource
    {
        $row = $this->service->create($request->all());

        return new CadUnidadeResource($row);
    }

    public function update(string $uuid, CadUnidadeRequest $request): Response
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

        return CadUnidadeResourceLookup::collection($rows);
    }


}
