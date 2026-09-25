<?php

namespace Padrao\Models\CadPersona;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadPersona extends Model {

    use HasUuid, HasFactory;

    protected $table        = 'cad_persona';
    protected $primaryKey   = 'id_persona';
    public    $incrementing = false;
    public    $timestamps   = false;
    protected $fillable     = [
       'dsc_persona',
    ];
}
