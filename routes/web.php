<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';


// Solo usuarios autenticados pueden acceder
Route::middleware(['auth'])->group(function () {

    // Rutas que solo pueden ver usuarios con el permiso 'articles.index'
    Route::get('/articles', [ArticlesController::class, 'index'])
        ->name('admin.index')
        ->middleware('permission:articles.index');

    // Crear artículo (solo admin)
    Route::get('/articles/create', [ArticlesController::class, 'create'])
        ->name('admin.create')
        ->middleware('permission:articles.create');
    Route::post('/articles', [ArticlesController::class, 'store'])
        ->name('admin.store')
        ->middleware('permission:articles.create');

    // Editar artículo (solo admin)
    Route::get('/articles/{id}/edit', [ArticlesController::class, 'edit'])
        ->name('admin.edit')
        ->middleware('permission:articles.edit');
    Route::put('/articles/{id}', [ArticlesController::class, 'update'])
        ->name('admin.update')
        ->middleware('permission:articles.edit');

    // Eliminar artículo (solo admin)
    Route::delete('/articles/{id}', [ArticlesController::class, 'destroy'])
        ->name('admin.destroy')
        ->middleware('permission:articles.delete');
});