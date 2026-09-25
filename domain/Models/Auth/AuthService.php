<?php

namespace Padrao\Models\Auth;

use Padrao\Models\CadUsuario\CadUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

class AuthService {

    public function __construct(private readonly Request $request){}

    public function login(string $email, string $senha): CadUsuario
    {
        $user = CadUsuario::where('email', $email)->first();

        throw_if(!$user || $user->senha != CriptoSenha($user->id_usuario, $senha), ValidationException::withMessages(['email' => Lang::get('login_senha_invalidos')]));

        $token = $user->createToken('token-api')->plainTextToken;

        $user->setActiveToken($token);

        return $user;
    }

    public function logout(Request $request): void
    {
        if ($user = $request->user()) {
            $user->currentAccessToken()?->delete();
        }
    }
}
