<?php

use Illuminate\Support\Facades\Route;
use Padrao\Models\CadMenuPermissao\CadMenuPermissaoController;
use Padrao\Models\MenuSistema\MenuSistemaController;

Route::group([
    'prefix' => 'sistema',
    'name' => 'sistema.sistema.',
    'namespace' => 'Modulos\Sistema',
    'middleware' => ['auth:sanctum']
], function () {

    Route::group(['prefix' => 'menu-sistema', 'as' => 'menu-sistema.'], function () {
        Route::get('', [MenuSistemaController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'permissao', 'as' => 'permissao.'], function () {
        Route::get('', [CadMenuPermissaoController::class, 'index'])->name('index');
        Route::get('{uuid}', [CadMenuPermissaoController::class, 'show'])->name('show');
        Route::put('', [CadMenuPermissaoController::class, 'update'])->name('update');
    });

});