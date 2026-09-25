<?php

namespace Padrao\Models\CadAvaliacaoAluno;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Padrao\Models\CadAvaliacaoAluno\Requests\CadAvaliacaoAlunoRequest;
use Padrao\Models\CadAvaliacaoAluno\Requests\CadAvaliacaoAlunoRequestFilter;
use Padrao\Models\CadAvaliacaoAluno\Resources\CadAvaliacaoAlunoResource;
use Padrao\Models\CadAvaliacaoAluno\Resources\CadAvaliacaoAlunoResourceLookup;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CadAvaliacaoAlunoController extends Controller
{
    public function __construct(protected CadAvaliacaoAlunoService $service) {}

    public function index(string $uuid, CadAvaliacaoAlunoRequestFilter $request): JsonResource
    {
        $row = $this->service->index($uuid, $request->all());

        return CadAvaliacaoAlunoResource::collection($row);
    }

    public function show(string $uuid_aluno,string $uuid): JsonResource
    {
        $row = $this->service->show($uuid);

        return new CadAvaliacaoAlunoResource($row);
    }

    public function store(string $uuid_aluno, CadAvaliacaoAlunoRequest $request): JsonResource {

        $data = $request->all();

        $data['arquivo'] = $request->file('arquivo');

        $row = $this->service->create($data);

        return new CadAvaliacaoAlunoResource($row);
    }

    public function update(string $uuid_aluno, string $uuid, CadAvaliacaoAlunoRequest $request): Response
    {
        $this->service->update($uuid, $request->all());

        return response()->noContent();
    }

    public function destroy(string $uuid_aluno, string $uuid): Response
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

    public function lookup(): JsonResource
    {
        $rows = $this->service->lookup();

        return CadAvaliacaoAlunoResourceLookup::collection($rows);
    }

}
