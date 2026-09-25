<?php

namespace Padrao\Models\CadProfessor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Padrao\Models\CadProfessor\Requests\CadProfessorRequest;
use Padrao\Models\CadProfessor\Requests\CadProfessorRequestFilter;
use Padrao\Models\CadProfessor\Resources\CadProfessorResource;
use Padrao\Models\CadProfessor\Resources\CadProfessorResourceLookup;

class CadProfessorController extends Controller
{
    public function __construct(protected CadProfessorService $service) {}

    public function index(CadProfessorRequestFilter $request): JsonResource
    {
        $row = $this->service->index($request->all());

        return CadProfessorResource::collection($row);
    }

    public function show(string $uuid): JsonResource
    {
        $row = $this->service->show($uuid);

        return new CadProfessorResource($row);
    }

    public function store(CadProfessorRequest $request): JsonResource
    {
        $row = $this->service->create($request->all());

        return new CadProfessorResource($row);
    }

    public function update(string $uuid, CadProfessorRequest $request): Response
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

        return CadProfessorResourceLookup::collection($rows);
    }
}
