<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckMenuPermission
{
    public function handle(Request $request, Closure $next, string $action, string $menuName)
    {
        $user = $request->user();

        $permission = DB::table('cad_menu_permissao')
            ->join('menu_sistema', 'menu_sistema.id_menu', '=', 'cad_menu_permissao.id_menu')
            ->where('cad_menu_permissao.perfil', $user->perfil)
            ->where('menu_sistema.nome_menu', strtolower($menuName))
            ->first();

        if (!$permission) {
            return response()->json(['error' => 'Sem permissão para este menu'], 403);
        }

        $allowed = match ($action) {
            'view'   => (bool) $permission->can_view,
            'create' => (bool) $permission->can_create,
            'update' => (bool) $permission->can_update,
            'delete' => (bool) $permission->can_delete,
        };

        if (!$allowed) {
            return response()->json(['error' => 'Ação não permitida'], 403);
        }

        return $next($request);
    }
}