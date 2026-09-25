<?php

namespace Padrao\Models\CadArquivo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadArquivo extends Model {

    use HasUuid, HasFactory;

    protected $table        = 'cad_arquivo';
    protected $primaryKey   = 'id_arquivo';
    public    $timestamps   = false;
    protected $fillable     = [
        'nome_original',
        'nome_fisico',
        'caminho',
    ];
}
