<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterBlogController;
use App\Http\Controllers\Admin\AdminController;

// Página principal de la plataforma
Route::get('/', fn() => view('welcome'));

// Registro de nuevos bloggers
Route::get('/register', [RegisterBlogController::class, 'show'])->name('register');
Route::post('/register', [RegisterBlogController::class, 'store']);
Route::get('/login', [RegisterBlogController::class, 'showLogin'])->name('login');
Route::post('/login', [RegisterBlogController::class, 'login']);
Route::post('/logout', [RegisterBlogController::class, 'logout'])->name('logout');

// Súper admin
Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::patch('tenants/{tenant}/suspend', [AdminController::class, 'suspend'])->name('admin.suspend');
        Route::delete('tenants/{tenant}', [AdminController::class, 'destroy'])->name('admin.destroy');
    });
