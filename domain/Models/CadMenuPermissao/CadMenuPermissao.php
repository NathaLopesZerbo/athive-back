<?php

namespace Padrao\Models\CadMenuPermissao;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Padrao\Models\MenuSistema\MenuSistema;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadMenuPermissao extends Model {

    use HasUuid, HasFactory;

    protected $table        = 'cad_menu_permissao';
    protected $primaryKey   = 'id_menu';
    public    $incrementing = false;
    public    $timestamps   = false;
    protected $fillable     = [
       'id_menu',
       'perfil',
       'can_view',
       'can_create',
       'can_update',
       'can_delete'
    ];

    protected $casts = [
        'can_view'   => 'boolean',
        'can_create' => 'boolean',
        'can_update' => 'boolean',
        'can_delete' => 'boolean',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(MenuSistema::class, 'id_menu', 'id_menu');
    }
}
