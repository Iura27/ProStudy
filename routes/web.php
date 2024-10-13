<?php


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\TarefasController;
use App\Http\Controllers\PerfilController;




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

});



Route::get('/dash', [DashController::class, 'index'])->name('dash');


Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');




Route::get('/', function () {
    return Inertia::render('Welcome', [
    ]);
});



