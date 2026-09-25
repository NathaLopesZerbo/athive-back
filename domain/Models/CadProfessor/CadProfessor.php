<?php

namespace Padrao\Models\CadProfessor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Padrao\Models\CadGenero\CadGenero;
use Padrao\Models\CadUsuario\CadUsuario;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadProfessor extends Model {

    use HasUuid, HasFactory;

    protected $table        = 'cad_professor';
    protected $primaryKey   = 'id_professor';
    public    $incrementing = true;
    public    $timestamps   = false;
    protected $fillable     = [
        'id_usuario',
        'id_genero',
        'idade',
        'telefone',
        'data_nascimento',
        'formacao'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(CadUsuario::class, 'id_usuario', 'id_usuario');
    }

    public function genero(): BelongsTo
    {
        return $this->belongsTo(CadGenero::class, 'id_genero', 'id_genero');
    }
}
