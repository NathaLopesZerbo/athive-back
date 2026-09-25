<?php

namespace Padrao\Models\CadEvento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Padrao\Models\CadAluno\CadAluno;
use Padrao\Models\CadArquivo\CadArquivo;
use Padrao\Models\CadTipoAvaliacao\CadTipoAvaliacao;
use Padrao\Models\CadUnidade\CadUnidade;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadEvento extends Model {

    use HasUuid, HasFactory;

    protected $table        = 'cad_evento';
    protected $primaryKey   = 'id_evento';
    public    $incrementing = false;
    public    $timestamps   = false;
    protected $fillable     = [
       'id_arquivo',
       'titulo_evento',
       'dsc_evento',
       'data_evento',
       'hora_inicio',
       'hora_fim',
       'local_evento'
    ];

    public function arquivo(): BelongsTo
    {
        return $this->belongsTo(CadArquivo::class, 'id_arquivo', 'id_arquivo');
    }

    public function unidade(): BelongsTo
    {
        return $this->belongsTo(CadUnidade::class, 'id_unidade', 'id_unidade');
    }
}
