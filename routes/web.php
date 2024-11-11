<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\LandingController::class, "landingPage" ])
    ->name('landing.page');

Route::get('/workspace', [App\Http\Controllers\LandingController::class, "workPageTemp" ])
    ->name('espacio.trabajo');

Route::get('/workspace/complete', [App\Http\Controllers\LandingController::class, "workPageCompleteTemp" ])
    ->name('espacio.completas');

Route::get('/workspace/create', [App\Http\Controllers\LandingController::class, "createComTemp" ])
    ->name('espacio.completas');

Route::get('/profile', [App\Http\Controllers\LandingController::class, "perfilTemp" ])
    ->name('user.profile');
