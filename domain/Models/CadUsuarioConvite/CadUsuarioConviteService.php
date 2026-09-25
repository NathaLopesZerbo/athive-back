<?php

namespace Padrao\Models\CadUsuarioConvite;

use App\Mail\ConviteProfessorMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Padrao\Models\CadUsuario\CadUsuario;

class CadUsuarioConviteService
{
    public function __construct(
        private CadUsuarioConviteRepository $repository
    ) {}

    public function create(CadUsuario $usuario): CadUsuarioConvite
    {
        $token = Str::random(40);

        $convite = $this->repository->create([
            'id_usuario' => $usuario->id_usuario,
            'token' => $token,
            'expiracao' => now()->addDays(2),
            'usado' => false,
        ]);

        Mail::to($usuario->email)
            ->send(new ConviteProfessorMail($token));

        return $convite;
    }
}