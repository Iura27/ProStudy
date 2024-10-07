<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashController;


Route::get('/horarios', [HorariosController::class, 'index'])->name('horarios.index');
Route::get('/horarios/create', [HorariosController::class, 'create'])->name('horarios.create');
Route::post('/horarios/store', [HorariosController::class, 'store'])->name('horarios.store');
Route::delete('/horarios/{id}/destroy', [HorariosController::class, 'destroy'])->name('horarios.destroy');
Route::get('/horarios/{id}/edit', [HorariosController::class, 'edit'])->name('horarios.edit');
Route::put('/horarios/{id}/update', [HorariosController::class, 'update'])->name('horarios.update');


Route::get('/dash', [DashController::class, 'index'])->name('dash');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
