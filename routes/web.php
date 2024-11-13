<?php

use Illuminate\Support\Facades\Route;

    // landing
Route::get('/', [App\Http\Controllers\LandingController::class, "landingPage" ])
    ->name('landing.page');

    // Area de trabajo
Route::get('/workspace', [App\Http\Controllers\ComisionesController::class, "workspace" ])
    ->name('espacio.trabajo')
    ->middleware('auth');

Route::get('/workspace/complete', [App\Http\Controllers\ComisionesController::class, "workspaceComplete" ])
    ->name('espacio.completas');

    // crear comision
Route::get('/workspace/create', [App\Http\Controllers\ComisionesController::class, "createComision" ])
    ->name('espacio.crear.form');

Route::post('/workspace/create', [App\Http\Controllers\ComisionesController::class, "createComisionProcess" ])
    ->name('espacio.crear.process');

    // ver comision
Route::get('/workspace/comision/{id}', [App\Http\Controllers\ComisionesController::class, "comisionDetail" ] )
    ->name('espacio.details')
    ->whereNumber('id');

Route::put('/workspace/comision/{id}', [App\Http\Controllers\ComisionesController::class, "completeComisionProcess"] )
    ->name('espacio.details.complete')
    ->whereNumber('id');

Route::delete('/workspace/comision/{id}', [App\Http\Controllers\ComisionesController::class, "deleteComision"] )
    ->name('espacio.details.delete')
    ->whereNumber('id');

    // Perfil
Route::get('/profile', [App\Http\Controllers\LandingController::class, "perfilTemp" ])
    ->name('user.profile');

    // Autentificación
Route::get('/login', [App\Http\Controllers\AuthController::class, "loginForm" ])
    ->name('auth.login.form');

Route::post('/login', [App\Http\Controllers\AuthController::class, "loginProcess" ])
    ->name('auth.login.process');

Route::post('/logout', [App\Http\Controllers\AuthController::class, "logoutProcess" ])
    ->name('auth.logout.process');

Route::get('/register', [App\Http\Controllers\AuthController::class, "registerForm" ])
    ->name('auth.register.form');
