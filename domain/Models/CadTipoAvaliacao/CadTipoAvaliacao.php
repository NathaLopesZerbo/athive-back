<?php

namespace Padrao\Models\CadTipoAvaliacao;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadTipoAvaliacao extends Model {

    use HasUuid, HasFactory;

    protected $table        = 'cad_tipo_avaliacao';
    protected $primaryKey   = 'id_tipo_avaliacao';
    public    $incrementing = false;
    public    $timestamps   = false;
    protected $fillable     = [
       'dsc_tipo_avaliacao',
    ];
}
