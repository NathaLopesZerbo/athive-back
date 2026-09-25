<?php

namespace Padrao\Models\CadTipoAvaliacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Padrao\Models\CadTipoAvaliacao\Requests\CadTipoAvaliacaoRequest;
use Padrao\Models\CadTipoAvaliacao\Requests\CadTipoAvaliacaoRequestFilter;
use Padrao\Models\CadTipoAvaliacao\Resources\CadTipoAvaliacaoResource;
use Padrao\Models\CadTipoAvaliacao\Resources\CadTipoAvaliacaoResourceLookup;

class CadTipoAvaliacaoController extends Controller
{
    public function __construct(protected CadTipoAvaliacaoService $service) {}

    public function index(CadTipoAvaliacaoRequestFilter $request): JsonResource
    {
        $row = $this->service->index($request->all());

        return CadTipoAvaliacaoResource::collection($row);
    }

    public function show(string $uuid): JsonResource
    {
        $row = $this->service->show($uuid);

        return new CadTipoAvaliacaoResource($row);
    }

    public function store(CadTipoAvaliacaoRequest $request): JsonResource
    {
        $row = $this->service->create($request->all());

        return new CadTipoAvaliacaoResource($row);
    }

    public function update(string $uuid, CadTipoAvaliacaoRequest $request): Response
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

        return CadTipoAvaliacaoResourceLookup::collection($rows);
    }
}
