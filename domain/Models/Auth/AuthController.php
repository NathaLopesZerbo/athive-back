<?php

namespace Padrao\Models\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Padrao\Models\CadUsuario\CadUsuario;
use Padrao\Models\CadUsuarioConvite\CadUsuarioConvite;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $service) {}
    
    public function login(AuthRequest $request): JsonResource
    {
        $usuEmail = $request->get('email');
        $usuSenha = $request->get('senha');

        $user = $this->service->login($usuEmail, $usuSenha);

        return new AuthLoginResource($user);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->service->logout($request);

        return response()->json(['message' => 'Deslogado com sucesso.']);
    }

    public function formAtivacao(Request $request)
    {
        return view('auth.ativar', [
            'token' => $request->token
        ]);
    }

    public function ativarConta(Request $request)
    {
        $convite = CadUsuarioConvite::where('token', $request->token)
            ->where('usado', false)
            ->firstOrFail();

        $usuario = CadUsuario::where('id_usuario', $convite->id_usuario)->first();

        $usuario->senha = CriptoSenha($usuario->id_usuario, $request->senha);
        $usuario->ativo = true;

        $usuario->save();

        $convite->usado = true;
        $convite->save();

        return redirect(env('FRONT_URL') . '/login');
    }

    public function me(): JsonResource
    {
        return new AuthLoginResource(auth()->user());
    }
}
