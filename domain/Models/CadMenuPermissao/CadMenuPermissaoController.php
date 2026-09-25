<?php

namespace Padrao\Models\CadMenuPermissao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Padrao\Models\CadMenuPermissao\Requests\CadMenuPermissaoRequest;
use Padrao\Models\CadMenuPermissao\Requests\CadMenuPermissaoRequestFilter;
use Padrao\Models\CadMenuPermissao\Resources\CadMenuPermissaoResource;

class CadMenuPermissaoController extends Controller
{
    public function __construct(protected CadMenuPermissaoService $service) {}

    public function index(CadMenuPermissaoRequestFilter $request): JsonResource
    {
        $row = $this->service->index($request->all());

        return CadMenuPermissaoResource::collection($row);
    }

    public function show(string $uuid): JsonResource
    {
        $row = $this->service->show($uuid);

        return new CadMenuPermissaoResource($row);
    }

    public function update(CadMenuPermissaoRequest $request): Response
    {
        $this->service->update($request->all());

        return response()->noContent();
    }
}
