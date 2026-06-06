<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\PublicBlogController;
use App\Http\Controllers\Tenant\PostController;
use App\Http\Controllers\Tenant\BlogSettingsController;
use App\Http\Controllers\RegisterBlogController;

Route::get('/test', function () {
    return 'tenant funcionando: ' . tenant('id');
});

Route::get('/', [PublicBlogController::class, 'index']);
Route::get('/post/{slug}', [PublicBlogController::class, 'show']);

Route::get('/login', [RegisterBlogController::class, 'showLogin'])->name('login');
Route::post('/login', [RegisterBlogController::class, 'login']);
Route::post('/logout', [RegisterBlogController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    Route::get('/settings', [BlogSettingsController::class, 'edit']);
    Route::put('/settings', [BlogSettingsController::class, 'update']);
});