<?php

use Illuminate\Support\Facades\Route;
use Padrao\Models\CadCamiseta\CadCamisetaController;
use Padrao\Models\CadGenero\CadGeneroController;
use Padrao\Models\CadPersona\CadPersonaController;
use Padrao\Models\CadProfessor\CadProfessorController;
use Padrao\Models\CadTipoAvaliacao\CadTipoAvaliacaoController;
use Padrao\Models\CadUnidade\CadUnidadeController;

Route::group([
    'prefix' => 'lookup',
    'name' => 'lookup.lookup.',
    'namespace' => 'Modulos\Lookup',
    'middleware' => ['auth:sanctum']
], function () {

    Route::get('professores', [CadProfessorController::class, 'lookup']);
    Route::get('camiseta', [CadCamisetaController::class, 'lookup']);
    Route::get('persona', [CadPersonaController::class, 'lookup']);
    Route::get('genero', [CadGeneroController::class, 'lookup']);
    Route::get('unidade', [CadUnidadeController::class, 'lookup']);
    Route::get('tipo-avaliacao', [CadTipoAvaliacaoController::class, 'lookup']);
});