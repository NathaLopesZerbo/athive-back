<?php

namespace Padrao\Models\CadAvaliacaoAluno;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Padrao\Models\CadAluno\CadAluno;
use Padrao\Models\CadArquivo\CadArquivo;
use Padrao\Models\CadTipoAvaliacao\CadTipoAvaliacao;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadAvaliacaoAluno extends Model {

    use HasUuid, HasFactory;

    protected $table        = 'cad_avaliacao_aluno';
    protected $primaryKey   = 'id_avaliacao_aluno';
    public    $incrementing = false;
    public    $timestamps   = false;
    protected $fillable     = [
       'id_aluno',
       'id_tipo_avaliacao',
       'id_arquivo',
       'dsc_avaliacao_aluno',
    ];

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(CadAluno::class, 'id_aluno', 'id_aluno');
    }

    public function tipoAvaliacao(): BelongsTo
    {
        return $this->belongsTo(CadTipoAvaliacao::class, 'id_tipo_avaliacao', 'id_tipo_avaliacao');
    }

    public function arquivo(): BelongsTo
    {
        return $this->belongsTo(CadArquivo::class, 'id_arquivo', 'id_arquivo');
    }
}
