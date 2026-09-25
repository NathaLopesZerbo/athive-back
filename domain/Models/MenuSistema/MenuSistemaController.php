<?php

namespace Padrao\Models\MenuSistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Padrao\Models\MenuSistema\Resources\MenuSistemaResource;

class MenuSistemaController extends Controller
{
    public function __construct(protected MenuSistemaService $service) {}

    public function index(): JsonResource
    {
        $perfil = auth()->user()->perfil;
        
        $row = $this->service->index($perfil);

        return MenuSistemaResource::collection($row);
    }
}
