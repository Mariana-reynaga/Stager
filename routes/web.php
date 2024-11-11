<?php

use Illuminate\Support\Facades\Route;

    // landing
Route::get('/', [App\Http\Controllers\LandingController::class, "landingPage" ])
    ->name('landing.page');

    // Area de trabajo
Route::get('/workspace', [App\Http\Controllers\ComisionesController::class, "workspace" ])
    ->name('espacio.trabajo');

Route::get('/workspace/complete', [App\Http\Controllers\ComisionesController::class, "workspaceComplete" ])
    ->name('espacio.completas');

Route::get('/workspace/create', [App\Http\Controllers\ComisionesController::class, "createComision" ])
    ->name('espacio.completas');

Route::get('/profile', [App\Http\Controllers\LandingController::class, "perfilTemp" ])
    ->name('user.profile');
