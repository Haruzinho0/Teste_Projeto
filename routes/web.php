<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\TreinoController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('alunos', AlunoController::class);
    Route::get('/alunos/search', [AlunoController::class, 'search'])->name('alunos.search');
    Route::delete('/alunos/{id}', [AlunoController::class, 'remove'])->name('alunos.remove');

    Route::resource('exercicios', ExercicioController::class);

    Route::resource('avaliacoes', AvaliacaoController::class);
    Route::get('/alunos/{aluno}/avaliacoes/create', [AvaliacaoController::class, 'create'])->name('avaliacao.create');
    Route::post('/alunos/{aluno}/avaliacoes', [AvaliacaoController::class, 'store'])->name('avaliacao.store');
    Route::get('/avaliacoes/{avaliacao}', [AvaliacaoController::class, 'show'])->name('avaliacao.show'); // Adicionando a rota de show


    Route::get('/alunos/{aluno}/avaliacao/create', [AvaliacaoController::class, 'create'])->name('avaliacao.create');
    Route::post('/alunos/{aluno}/avaliacao', [AvaliacaoController::class, 'store'])->name('avaliacao.store');
    Route::get('/avaliacoes/{avaliacao}', [AvaliacaoController::class, 'show'])->name('avaliacao.show');
    Route::get('/avaliacoes/{avaliacao}/edit', [AvaliacaoController::class, 'edit'])->name('avaliacao.edit');
    Route::put('/avaliacoes/{avaliacao}', [AvaliacaoController::class, 'update'])->name('avaliacao.update');
    Route::delete('/avaliacoes/{id}', [AvaliacaoController::class, 'destroy'])->name('avaliacao.destroy');

});

require __DIR__.'/auth.php';
