<?php

namespace Padrao\Models\CadUnidade;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadUnidade extends Model {

    use HasUuid, HasFactory;

    protected $table        = 'cad_unidade';
    protected $primaryKey   = 'id_unidade';
    public    $incrementing = false;
    public    $timestamps   = false;
    protected $fillable     = [
       'nome_unidade',
    ];
}
