<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cad_consulta_anual', function (Blueprint $table) {
            $table->integer('id_consulta_anual', true);
            $table->integer('id_aluno');
            $table->string('dsc_consulta');
            $table->char('cardiopatia', 1)->nullable();
            $table->char('pressao_arterial', 1)->nullable();
            $table->char('diabete', 1)->nullable();
            $table->char('glicemia', 1)->nullable();
            $table->char('colesterol', 1)->nullable();
            $table->char('triglicerideos', 1)->nullable();
            $table->char('obesidade', 1)->nullable();
            $table->char('problema_vascular', 1)->nullable();
            $table->char('tireoide', 1)->nullable();
            $table->char('osteoporose', 1)->nullable();
            $table->char('cancer', 1)->nullable();
            $table->char('asma_bronquite', 1)->nullable();
            $table->char('alergia', 1)->nullable();
            $table->char('cirurgias', 1)->nullable();
            $table->char('fraturas', 1)->nullable();
            $table->char('entorse_luxacao', 1)->nullable();
            $table->char('dor_cabeca', 1)->nullable();
            $table->char('anemia', 1)->nullable();
            $table->char('gastrite_refluxo', 1)->nullable();
            $table->char('desmaio', 1)->nullable();
            $table->char('convulsao', 1)->nullable();
            $table->char('tabagismo', 1)->nullable();
            $table->string('outras_patologias')->nullable();
            $table->string('medicamento_em_uso')->nullable();
            $table->char('dor_desconforto_peito', 1)->nullable();
            $table->char('falta_ar_esforco_leve', 1)->nullable();
            $table->char('falta_ar_repouso', 1)->nullable();
            $table->char('tontura', 1)->nullable();
            $table->char('palpitacoes', 1)->nullable();
            $table->char('cansaco_avds', 1)->nullable();
            $table->char('dor_caminhar', 1)->nullable();
            $table->char('apneia_ronco', 1)->nullable();
            $table->string('classifica_sono')->nullable();
            $table->string('localizacao')->nullable();
            $table->string('intensidade', 40)->nullable();
            $table->string('tipo_dor', 40)->nullable();
            $table->string('frequencia_dor', 40)->nullable();
            $table->string('tempo_dor', 40)->nullable();
            $table->string('tratamento', 100)->nullable();
            $table->string('quando_piora', 100)->nullable();
            $table->string('quando_melhora', 100)->nullable();
            $table->string('obs_dor')->nullable();
            $table->string('nutricionista')->nullable();
            $table->string('cafe_manha')->nullable();
            $table->string('lanche_manha')->nullable();
            $table->string('almoco')->nullable();
            $table->string('lanche_tarde')->nullable();
            $table->string('jantar')->nullable();
            $table->string('lanche_noite')->nullable();
            $table->string('agua_quantidade', 100)->nullable();
            $table->string('bebida_alcool', 100)->nullable();
            $table->string('suple_vita')->nullable();
            $table->string('obs_nutricional')->nullable();
            $table->string('exer_praticou')->nullable();
            $table->string('exer_atuais')->nullable();
            $table->string('parado_tempo', 100)->nullable();
            $table->string('obs_exer')->nullable();
            $table->string('lab_postura', 100)->nullable();
            $table->string('lab_caract', 100)->nullable();
            $table->string('obs_lab')->nullable();
            $table->string('per_peso', 100)->nullable();
            $table->string('per_quant', 100)->nullable();
            $table->string('obs_per')->nullable();
            $table->string('obj_quais')->nullable();
            $table->string('obs_objetivo')->nullable();
            $table->string('met_quais')->nullable();
            $table->string('obs_metas')->nullable();
            $table->string('uuid', 36)->default(DB::raw('(UUID())'));

            $table->foreign('id_aluno', 'fk_consulta_anual_aluno')->references('id_aluno')->on('cad_aluno');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cad_consulta_anual');
    }
};
