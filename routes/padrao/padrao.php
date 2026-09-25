<?php

use Illuminate\Support\Facades\Route;
use Padrao\Models\CadAluno\CadAlunoController;
use Padrao\Models\CadAvaliacaoAluno\CadAvaliacaoAlunoController;
use Padrao\Models\CadCamiseta\CadCamisetaController;
use Padrao\Models\CadConsultaAnual\CadConsultaAnualController;
use Padrao\Models\CadEvento\CadEventoController;
use Padrao\Models\CadGenero\CadGeneroController;
use Padrao\Models\CadPersona\CadPersonaController;
use Padrao\Models\CadProfessor\CadProfessorController;
use Padrao\Models\CadTipoAvaliacao\CadTipoAvaliacaoController;
use Padrao\Models\CadUnidade\CadUnidadeController;
use Padrao\Models\CadUsuario\CadUsuarioController;

Route::group([
    'prefix' => 'padrao',
    'name' => 'padrao.padrao.',
    'namespace' => 'Modulos\Padrao',
    'middleware' => ['auth:sanctum']
], function () {

    Route::group(['prefix' => 'usuario', 'as' => 'usuario.'], function () {
        Route::get('', [CadUsuarioController::class, 'index'])->name('index');
        Route::get('{usuario}', [CadUsuarioController::class, 'show'])->name('show');
        Route::post('', [CadUsuarioController::class, 'store'])->name('store');
        Route::put('{usuario}', [CadUsuarioController::class, 'update'])->name('update');
        Route::delete('{usuario}', [CadUsuarioController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'professor', 'as' => 'professor.'], function () {
        Route::get('', [CadProfessorController::class, 'index'])->name('index')->middleware(['menu.permission:view,lista-professor']);
        Route::get('{professor}', [CadProfessorController::class, 'show'])->name('show')->middleware(['menu.permission:view,lista-professor']);
        Route::post('', [CadProfessorController::class, 'store'])->name('store')->middleware(['menu.permission:create,lista-professor']);
        Route::put('{professor}', [CadProfessorController::class, 'update'])->name('update')->middleware(['menu.permission:update,lista-professor']);
        Route::delete('{professor}', [CadProfessorController::class, 'destroy'])->name('destroy')->middleware(['menu.permission:delete,lista-professor']);
    });

    Route::group(['prefix' => 'aluno', 'as' => 'aluno.'], function () {
        Route::get('', [CadAlunoController::class, 'index'])->name('index')->middleware(['menu.permission:view,lista-aluno']);
        Route::get('{aluno}', [CadAlunoController::class, 'show'])->name('show')->middleware(['menu.permission:view,lista-aluno']);
        Route::post('', [CadAlunoController::class, 'store'])->name('store')->middleware(['menu.permission:create,lista-aluno']);
        Route::put('{aluno}', [CadAlunoController::class, 'update'])->name('update')->middleware(['menu.permission:update,lista-aluno']);
        Route::delete('{aluno}', [CadAlunoController::class, 'destroy'])->name('destroy')->middleware(['menu.permission:delete,lista-aluno']);

        Route::group(['prefix' => '{uuid_aluno}/consulta-anual', 'as' => 'consulta-anual.'], function () {
            Route::get('', [CadConsultaAnualController::class, 'index'])->name('index')->middleware(['menu.permission:view,lista-aluno']);
            Route::get('{consultaAnual}', [CadConsultaAnualController::class, 'show'])->name('show')->middleware(['menu.permission:view,lista-aluno']);
            Route::post('', [CadConsultaAnualController::class, 'store'])->name('store')->middleware(['menu.permission:create,lista-aluno']);
            Route::put('{consultaAnual}', [CadConsultaAnualController::class, 'update'])->name('update')->middleware(['menu.permission:update,lista-aluno']);
            Route::delete('{consultaAnual}', [CadConsultaAnualController::class, 'destroy'])->name('destroy')->middleware(['menu.permission:delete,lista-aluno']);
        });

        Route::group(['prefix' => '{uuid_aluno}/avaliacao', 'as' => 'avaliacao.'], function () {
            Route::get('', [CadAvaliacaoAlunoController::class, 'index'])->name('index')->middleware(['menu.permission:view,lista-aluno']);
            Route::get('{avaliacao}', [CadAvaliacaoAlunoController::class, 'show'])->name('show')->middleware(['menu.permission:view,lista-aluno']);
            Route::post('', [CadAvaliacaoAlunoController::class, 'store'])->name('store')->middleware(['menu.permission:create,lista-aluno']);
            Route::put('{avaliacao}', [CadAvaliacaoAlunoController::class, 'update'])->name('update')->middleware(['menu.permission:update,lista-aluno']);
            Route::delete('{avaliacao}', [CadAvaliacaoAlunoController::class, 'destroy'])->name('destroy')->middleware(['menu.permission:delete,lista-aluno']);
            Route::get('{arquivo}/download', [CadAvaliacaoAlunoController::class, 'download'])->name('download')->middleware(['menu.permission:view,lista-aluno']);
        });
    });

    Route::group(['prefix' => 'camiseta', 'as' => 'camiseta.'], function () {
        Route::get('', [CadCamisetaController::class, 'index'])->name('index')->middleware(['menu.permission:view,camiseta']);
        Route::get('{camiseta}', [CadCamisetaController::class, 'show'])->name('show')->middleware(['menu.permission:view,camiseta']);
        Route::post('', [CadCamisetaController::class, 'store'])->name('store')->middleware(['menu.permission:create,camiseta']);
        Route::put('{camiseta}', [CadCamisetaController::class, 'update'])->name('update')->middleware(['menu.permission:update,camiseta']);
        Route::delete('{camiseta}', [CadCamisetaController::class, 'destroy'])->name('destroy')->middleware(['menu.permission:delete,camiseta']);
    });

    Route::group(['prefix' => 'persona', 'as' => 'persona.'], function () {
        Route::get('', [CadPersonaController::class, 'index'])->name('index')->middleware(['menu.permission:view,persona']);
        Route::get('{persona}', [CadPersonaController::class, 'show'])->name('show')->middleware(['menu.permission:view,persona']);
        Route::post('', [CadPersonaController::class, 'store'])->name('store')->middleware(['menu.permission:create,persona']);
        Route::put('{persona}', [CadPersonaController::class, 'update'])->name('update')->middleware(['menu.permission:update,persona']);
        Route::delete('{persona}', [CadPersonaController::class, 'destroy'])->name('destroy')->middleware(['menu.permission:delete,persona']);
    });

    Route::group(['prefix' => 'genero', 'as' => 'genero.'], function () {
        Route::get('', [CadGeneroController::class, 'index'])->name('index')->middleware(['menu.permission:view,genero']);
        Route::get('{genero}', [CadGeneroController::class, 'show'])->name('show')->middleware(['menu.permission:view,genero']);
        Route::post('', [CadGeneroController::class, 'store'])->name('store')->middleware(['menu.permission:create,genero']);
        Route::put('{genero}', [CadGeneroController::class, 'update'])->name('update')->middleware(['menu.permission:update,genero']);
        Route::delete('{genero}', [CadGeneroController::class, 'destroy'])->name('destroy')->middleware(['menu.permission:delete,genero']);
    }); 

    Route::group(['prefix' => 'unidade', 'as' => 'unidade.'], function () {
        Route::get('', [CadUnidadeController::class, 'index'])->name('index')->middleware(['menu.permission:view,unidade']);
        Route::get('{unidade}', [CadUnidadeController::class, 'show'])->name('show')->middleware(['menu.permission:view,unidade']);
        Route::post('', [CadUnidadeController::class, 'store'])->name('store')->middleware(['menu.permission:create,unidade']);
        Route::put('{unidade}', [CadUnidadeController::class, 'update'])->name('update')->middleware(['menu.permission:update,unidade']);
        Route::delete('{unidade}', [CadUnidadeController::class, 'destroy'])->name('destroy')->middleware(['menu.permission:delete,unidade']);
    });

    Route::group(['prefix' => 'tipo-avaliacao', 'as' => 'tipo-avaliacao.'], function () {
        Route::get('', [CadTipoAvaliacaoController::class, 'index'])->name('index')->middleware(['menu.permission:view,tipo-avaliacao']);
        Route::get('{tipoAvaliacao}', [CadTipoAvaliacaoController::class, 'show'])->name('show')->middleware(['menu.permission:view,tipo-avaliacao']);
        Route::post('', [CadTipoAvaliacaoController::class, 'store'])->name('store')->middleware(['menu.permission:create,tipo-avaliacao']);
        Route::put('{tipoAvaliacao}', [CadTipoAvaliacaoController::class, 'update'])->name('update')->middleware(['menu.permission:update,tipo-avaliacao']);
        Route::delete('{tipoAvaliacao}', [CadTipoAvaliacaoController::class, 'destroy'])->name('destroy')->middleware(['menu.permission:delete,tipo-avaliacao']);
    });

    Route::group(['prefix' => 'evento', 'as' => 'evento.'], function () {
        Route::get('', [CadEventoController::class, 'index'])->name('index')->middleware(['menu.permission:view,evento']);
        Route::get('{evento}', [CadEventoController::class, 'show'])->name('show')->middleware(['menu.permission:view,evento']);
        Route::post('', [CadEventoController::class, 'store'])->name('store')->middleware(['menu.permission:create,evento']);
        Route::put('{evento}', [CadEventoController::class, 'update'])->name('update')->middleware(['menu.permission:update,evento']);
        Route::delete('{evento}', [CadEventoController::class, 'destroy'])->name('destroy')->middleware(['menu.permission:delete,evento']);
    });
});