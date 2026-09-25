<?php

namespace Padrao\Models\MenuSistema;

use App\Observers\MenuSistemaObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Padrao\Models\CadMenuPermissao\CadMenuPermissao;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class MenuSistema extends Model {

    use HasUuid, HasFactory;

    protected $table        = 'menu_sistema';
    protected $primaryKey   = 'id_menu';
    public    $timestamps   = false;
    protected $fillable     = [
       'nome_menu',
       'nome_exibicao',
       'descricao_menu',
       'icone_menu',
       'ordem_menu',
       'ativo_menu',
       'parent_id'
    ];

    protected $casts = [
        'ativo_menu' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::observe(MenuSistemaObserver::class);
    }

    public function permissoes(): HasMany
    {
        return $this->hasMany(CadMenuPermissao::class, 'id_menu', 'id_menu');
    }
}
