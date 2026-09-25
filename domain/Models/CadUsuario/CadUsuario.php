<?php

namespace Padrao\Models\CadUsuario;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Padrao\Models\CadAluno\CadAluno;
use Padrao\Models\CadProfessor\CadProfessor;
use Padrao\Models\CadUnidade\CadUnidade;
use Padrao\Models\CadUsuarioConvite\CadUsuarioConvite;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadUsuario extends Model implements AuthenticatableContract {

    use Authenticatable, HasUuid, HasFactory, HasApiTokens;

    protected $table        = 'cad_usuario';
    protected $primaryKey   = 'id_usuario';
    public    $incrementing = false;
    public    $timestamps   = false;
    private   string       $activeToken;

    protected $fillable = [
        'id_unidade',
        'usuario',
        'senha',
        'nome_usuario',
        'sobrenome',
        'email',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id_usuario = maximoId('cad_usuario', 'id_usuario');
            $model->usuario    = $model->nome_usuario;
            $model->ativo      = false;
        });
    }

    public function usuarioConvite(): HasOne
    {
        return $this->hasOne(CadUsuarioConvite::class, 'id_usuario', 'id_usuario');
    }

    public function unidade(): BelongsTo
    {
        return $this->belongsTo(CadUnidade::class, 'id_unidade', 'id_unidade');
    }

    public function professor(): HasOne
    {
        return $this->hasOne(CadProfessor::class, 'id_usuario', 'id_usuario');
    }

    public function aluno(): HasOne
    {
        return $this->hasOne(CadAluno::class, 'id_usuario', 'id_usuario');
    }

    public function setActiveToken(string $token): void
    {
        $this->activeToken = $token;
    }

    public function getActiveToken(): string|null
    {
        return $this->activeToken ?? null;
    }

    public function getPerfilAttribute()
    {
        if ($this->professor()->exists()) {
            return 'PROFESSOR';
        }

        if ($this->aluno()->exists()) {
            return 'ALUNO';
        }

        return 'ADMIN';
    }
}