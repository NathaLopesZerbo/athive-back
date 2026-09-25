<?php

namespace Padrao\Models\CadAluno;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Padrao\Models\CadCamiseta\CadCamiseta;
use Padrao\Models\CadGenero\CadGenero;
use Padrao\Models\CadPersona\CadPersona;
use Padrao\Models\CadProfessor\CadProfessor;
use Padrao\Models\CadUsuario\CadUsuario;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadAluno extends Model {

    use HasUuid, HasFactory;

    protected $table        = 'cad_aluno';
    protected $primaryKey   = 'id_aluno';
    public    $incrementing = false;
    public    $timestamps   = false;
    protected $fillable     = [
        'id_usuario',
        'id_professor',
        'id_genero',
        'id_camiseta',
        'id_persona',
        'tam_camiseta',
        'idade',
        'telefone',
        'data_nascimento',
        'data_inicio'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(CadUsuario::class, 'id_usuario', 'id_usuario');
    }

    public function professor(): BelongsTo
    {
        return $this->belongsTo(CadProfessor::class, 'id_professor', 'id_professor');
    }

    public function genero(): BelongsTo
    {
        return $this->belongsTo(CadGenero::class, 'id_genero', 'id_genero');
    }

    public function camiseta(): BelongsTo
    {
        return $this->belongsTo(CadCamiseta::class, 'id_camiseta', 'id_camiseta');
    }

    public function persona(): BelongsTo
    {
        return $this->belongsTo(CadPersona::class, 'id_persona', 'id_persona');
    }
}
