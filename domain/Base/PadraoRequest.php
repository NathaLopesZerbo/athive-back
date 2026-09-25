<?php

namespace Padrao\Base;

use Illuminate\Foundation\Http\FormRequest;

class PadraoRequest extends FormRequest {

    public function authorize()
    {
        return true;
    }
}
