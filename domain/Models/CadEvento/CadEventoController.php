<?php

namespace Padrao\Models\CadEvento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Padrao\Models\CadEvento\Requests\CadEventoRequest;
use Padrao\Models\CadEvento\Requests\CadEventoRequestFilter;
use Padrao\Models\CadEvento\Resources\CadEventoResource;
use Padrao\Models\CadEvento\Resources\CadEventoResourceLookup;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CadEventoController extends Controller
{
    public function __construct(protected CadEventoService $service) {}

    public function index(CadEventoRequestFilter $request): JsonResource
    {
        $row = $this->service->index($request->all());

        return CadEventoResource::collection($row);
    }

    public function show(string $uuid): JsonResource
    {
        $row = $this->service->show($uuid);

        return new CadEventoResource($row);
    }

    public function store(CadEventoRequest $request): JsonResource {

        $data = $request->all();

        $data['arquivo'] = $request->file('arquivo');

        $row = $this->service->create($data);

        return new CadEventoResource($row);
    }

    public function update(string $uuid, CadEventoRequest $request): Response
    {
        $this->service->update($uuid, $request->all());

        return response()->noContent();
    }

    public function destroy(string $uuid): Response
    {
        $this->service->delete($uuid);

        return response()->noContent();
    }

    public function download(string $uuid_aluno, string $uuid): BinaryFileResponse
    {
        $file = $this->service->download($uuid);

        return response()->download(
            $file['path'],
            $file['nome'],
            [
                'Content-Type' => mime_content_type($file['path'])
            ]
        );
    }

}
