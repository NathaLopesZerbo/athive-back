<?php

namespace Padrao\Models\CadGenero;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadGenero extends Model {

    use HasUuid, HasFactory;

    protected $table        = 'cad_genero';
    protected $primaryKey   = 'id_genero';
    public    $incrementing = false;
    public    $timestamps   = false;
    protected $fillable     = [
       'dsc_genero',
    ];
}
