<?php

namespace Padrao\Models\CadConsultaAnual;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Padrao\Models\CadAluno\CadAluno;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadConsultaAnual extends Model {

    use HasUuid, HasFactory;

    protected $table        = 'cad_consulta_anual';
    protected $primaryKey   = 'id_consulta_anual';
    public    $incrementing = false;
    public    $timestamps   = false;
    protected $fillable     = [
        'id_consulta_anual',
        'id_aluno',
        'dsc_consulta',
        'cardiopatia',
        'pressao_arterial',
        'diabete',
        'glicemia',
        'colesterol',
        'triglicerideos',
        'obesidade',
        'problema_vascular',
        'tireoide',
        'osteoporose',
        'cancer',
        'asma_bronquite',
        'alergia',
        'cirurgias',
        'fraturas',
        'entorse_luxacao',
        'dor_cabeca',
        'anemia',
        'gastrite_refluxo',
        'desmaio',
        'convulsao',
        'tabagismo',
        'outras_patologias',
        'medicamento_em_uso',
        'dor_desconforto_peito',
        'falta_ar_esforco_leve',
        'falta_ar_repouso',
        'tontura',
        'palpitacoes',
        'cansaco_avds',
        'dor_caminhar',
        'apneia_ronco',
        'classifica_sono',
        'localizacao',
        'intensidade',
        'tipo_dor',
        'frequencia_dor',
        'tempo_dor',
        'tratamento',
        'quando_piora',
        'quando_melhora',
        'obs_dor',
        'nutricionista',
        'cafe_manha',
        'lanche_manha',
        'almoco',
        'lanche_tarde',
        'jantar',
        'lanche_noite',
        'agua_quantidade',
        'bebida_alcool',
        'suple_vita',
        'obs_nutricional',
        'exer_praticou',
        'exer_atuais',
        'parado_tempo',
        'obs_exer',
        'lab_postura',
        'lab_caract',
        'obs_lab',
        'per_peso',
        'per_quant',
        'obs_per',
        'obj_quais',
        'obs_objetivo',
        'met_quais',
        'obs_metas'
    ];

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(CadAluno::class, 'id_aluno', 'id_aluno');
    }
}
