<?php

namespace Padrao\Models\CadUsuarioConvite;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadUsuarioConvite extends Model {

    use HasUuid, HasFactory;

    protected $table        = 'cad_usuario_convite';
    protected $primaryKey   = 'id_convite';
    public    $incrementing = true;
    public    $timestamps   = false;
    protected $fillable     = [
       'id_usuario',
       'token',
       'expiracao',
       'usado'
    ];
}
