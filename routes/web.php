<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AlunoController;


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
});

Route::get('/aluno', function () {
    return Inertia::render('Welcome'); 
});

Route::middleware(['auth'])->group(function () {
    Route::resource('alunos', AlunoController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/alunos/create', [AlunoController::class, 'create'])->name('aluno.create');
    Route::resource('alunos', AlunoController::class);
});


Route::get('/alunos', function () {
    $alunos = App\Models\Aluno::all();
    return view('alunos', compact('alunos'));
})->name('alunos');


Route::get('/alunos', [AlunoController::class, 'index'])->name('alunos.index');

Route::get('/alunos/{aluno}', [AlunoController::class, 'show'])->name('alunos.show');



Route::get('/alunos', [AlunoController::class, 'index'])->name('alunos.index');
Route::get('/alunos/search', [AlunoController::class, 'search'])->name('alunos.search');

Route::delete('/alunos/{id}', [AlunoController::class, 'destroy'])->name('alunos.destroy');


require __DIR__.'/auth.php';



