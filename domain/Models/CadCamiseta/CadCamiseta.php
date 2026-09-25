<?php

namespace Padrao\Models\CadCamiseta;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadCamiseta extends Model {

    use HasUuid, HasFactory;

    protected $table        = 'cad_camiseta';
    protected $primaryKey   = 'id_camiseta';
    public    $incrementing = false;
    public    $timestamps   = false;
    protected $fillable     = [
       'dsc_camiseta',
       'cor'
    ];
}
