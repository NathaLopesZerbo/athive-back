<?php

namespace Padrao\Models\CadArquivo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Padrao\Models\CadArquivo\Requests\CadArquivoRequest;
use Padrao\Models\CadArquivo\Requests\CadArquivoRequestFilter;
use Padrao\Models\CadArquivo\Resources\CadArquivoResource;
use Padrao\Models\CadArquivo\Resources\CadArquivoResourceLookup;

class CadArquivoController extends Controller
{
    public function __construct(protected CadArquivoService $service) {}

    public function index(string $uuid, CadArquivoRequestFilter $request): JsonResource
    {
        $row = $this->service->index($uuid, $request->all());

        return CadArquivoResource::collection($row);
    }

    public function show(string $uuid_aluno, string $uuid): JsonResource
    {
        $row = $this->service->show($uuid);

        return new CadArquivoResource($row);
    }

    public function store(string $uuid_aluno, CadArquivoRequest $request): JsonResource
    {
        $row = $this->service->create($request->file('arquivo'), $request->tipo_pasta);

        return new CadArquivoResource($row);
    }

    public function update(string $uuid_aluno, string $uuid, CadArquivoRequest $request): Response
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

        return CadArquivoResourceLookup::collection($rows);
    }

}
