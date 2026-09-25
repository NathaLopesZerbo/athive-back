<?php

namespace Padrao\Models\Auth;

use Padrao\Base\PadraoRequest;
use Illuminate\Validation\Rules\Password;

class AuthRequest extends PadraoRequest {

    public function rules()
    {
        return [
            'email'   => ['required', 'string', 'email', 'max:255'],
            'senha'   => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
        ];
    }
}
