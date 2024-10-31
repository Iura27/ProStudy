<?php


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\TarefasController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\LembreteController;
use App\Http\Controllers\PlanoDeEstudoController;




Auth::routes();

Route::middleware(['auth'])->group(function () {
Route::prefix('horarios')->group(function () {
    Route::get('/', [HorariosController::class, 'index'])->name('horarios.index');
    Route::get('/create', [HorariosController::class, 'create'])->name('horarios.create');
    Route::post('/store', [HorariosController::class, 'store'])->name('horarios.store');
    Route::delete('/{id}/destroy', [HorariosController::class, 'destroy'])->name('horarios.destroy');
    Route::get('/{id}/edit', [HorariosController::class, 'edit'])->name('horarios.edit');
    Route::put('/{id}/update', [HorariosController::class, 'update'])->name('horarios.update');
});


Route::prefix('tarefas')->group(function () {
    Route::get('/', [TarefasController::class, 'index'])->name('tarefas.index');
    Route::get('/create', [TarefasController::class, 'create'])->name('tarefas.create');
    Route::post('/store', [TarefasController::class, 'store'])->name('tarefas.store');
    Route::delete('/{id}/destroy', [TarefasController::class, 'destroy'])->name('tarefas.destroy');
    Route::get('/{id}/edit', [TarefasController::class, 'edit'])->name('tarefas.edit');
    Route::put('/{id}/update', [TarefasController::class, 'update'])->name('tarefas.update');
});

Route::prefix('lembretes')->group(function () {
    Route::get('/', [LembreteController::class, 'index'])->name('lembretes.index');
    Route::get('/create', [LembreteController::class, 'create'])->name('lembretes.create');
    Route::post('/store', [LembreteController::class, 'store'])->name('lembretes.store');
    Route::delete('/{id}/destroy', [LembreteController::class, 'destroy'])->name('lembretes.destroy');
    Route::get('/{id}/edit', [LembreteController::class, 'edit'])->name('lembretes.edit');
    Route::put('/{id}/update', [LembreteController::class, 'update'])->name('lembretes.update');
});

Route::prefix('planos')->group(function () {
    Route::get('/', [PlanoDeEstudoController::class, 'index'])->name('planos.index'); // Listar planos de estudo
    Route::get('/create', [PlanoDeEstudoController::class, 'create'])->name('planos.create'); // Exibir formulário de criação
    Route::post('/store', [PlanoDeEstudoController::class, 'store'])->name('planos.store'); // Salvar novo plano
    Route::delete('/{id}/destroy', [PlanoDeEstudoController::class, 'destroy'])->name('planos.destroy'); // Deletar plano
    Route::get('/{id}/edit', [PlanoDeEstudoController::class, 'edit'])->name('planos.edit'); // Exibir formulário de edição
    Route::put('/{id}/update', [PlanoDeEstudoController::class, 'update'])->name('planos.update'); // Atualizar plano
});


Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
Route::put('/perfil/{id}', [PerfilController::class, 'update'])->name('perfil.update');
Route::delete('/perfil/delete', [ProfileController::class, 'delete'])->name('perfil.delete');

Route::post('/horarios/{id}/update-status', [HorariosController::class, 'updateStatus'])->name('horarios.updateStatus');
Route::post('/tarefas/{id}/update-status', [TarefasController::class, 'updateStatus'])->name('tarefas.updateStatus');
Route::post('/planos/{id}/update-status', [PlanoDeEstudoController::class, 'updateStatus'])->name('planos.updateStatus');

});



Route::get('/dash', [DashController::class, 'dashboard'])->name('dash');






Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::get('/register', function () {
    return view('auth.register');
})->name('register');



Route::get('/', function () {
    return Inertia::render('Welcome', [
    ]);
});



