<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\PublicBlogController;
use App\Http\Controllers\Tenant\PostController;
use App\Http\Controllers\Tenant\BlogSettingsController;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    // Blog público
    Route::get('/', [PublicBlogController::class, 'index']);
    Route::get('/post/{slug}', [PublicBlogController::class, 'show']);

    // Dashboard del blogger
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
});

