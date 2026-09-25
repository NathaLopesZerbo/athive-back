<?php

namespace Padrao\Models\CadAluno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Padrao\Models\CadAluno\Requests\CadAlunoRequest;
use Padrao\Models\CadAluno\Requests\CadAlunoRequestFilter;
use Padrao\Models\CadAluno\Resources\CadAlunoResource;
use Padrao\Models\CadAluno\Resources\CadAlunoResourceLookup;

class CadAlunoController extends Controller
{
    public function __construct(protected CadAlunoService $service) {}

    public function index(CadAlunoRequestFilter $request): JsonResource
    {
        $row = $this->service->index($request->all());

        return CadAlunoResource::collection($row);
    }

    public function show(string $uuid): JsonResource
    {
        $row = $this->service->show($uuid);

        return new CadAlunoResource($row);
    }

    public function store(CadAlunoRequest $request): JsonResource
    {
        $row = $this->service->create($request->all());

        return new CadAlunoResource($row);
    }

    public function update(string $uuid, CadAlunoRequest $request): Response
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

        return CadAlunoResourceLookup::collection($rows);
    }
}
