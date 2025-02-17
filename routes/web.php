<?php

use Illuminate\Support\Facades\Route;

    // landing
Route::get('/', [App\Http\Controllers\LandingController::class, "landingPage" ])
    ->name('landing.page');

    // Area de trabajo
Route::get('/workspace/{user_id}', [App\Http\Controllers\ComisionesController::class, "workspace" ])
    ->name('espacio.trabajo')
    ->whereNumber('user_id')
    ->middleware('auth')
    ->middleware('UserUrlCheck');

Route::get('/workspace/{user_id}/complete', [App\Http\Controllers\ComisionesController::class, "workspaceComplete" ])
    ->name('espacio.completas')
    ->whereNumber('user_id')
    ->middleware('auth')
    ->middleware('UserUrlCheck');

    // crear comision
Route::get('/workspace/create', [App\Http\Controllers\ComisionesController::class, "createComision" ])
    ->name('espacio.crear.form')
    ->middleware('auth');

Route::post('/workspace/create', [App\Http\Controllers\ComisionesController::class, "createComisionProcess" ])
    ->name('espacio.crear.process')
    ->middleware('auth');

    // ver comision
Route::get('/workspace/comision/{id}', [App\Http\Controllers\ComisionesController::class, "comisionDetail" ] )
    ->name('espacio.details')
    ->whereNumber('id')
    ->middleware('auth');

    // Completar comision
Route::put('/workspace/comision/{id}', [App\Http\Controllers\ComisionesController::class, "completeComisionProcess"] )
    ->name('espacio.details.complete')
    ->whereNumber('id')
    ->middleware('auth');

    // Editar comision
Route::get('/workspace/comision/editar/{id}', [App\Http\Controllers\ComisionesController::class, "editComision" ] )
    ->name('espacio.edit')
    ->whereNumber('id')
    ->middleware('auth');

Route::put('/workspace/comision/editar/{id}', [App\Http\Controllers\ComisionesController::class, "editComisionProcess" ] )
    ->name('espacio.edit.process')
    ->whereNumber('id')
    ->middleware('auth');

    // Eliminar comision
Route::delete('/workspace/comision/{id}', [App\Http\Controllers\ComisionesController::class, "deleteComision"] )
    ->name('espacio.details.delete')
    ->whereNumber('id')
    ->middleware('auth');

    // Perfil
Route::get('/profile/{user_id}', [App\Http\Controllers\AuthController::class, "profile" ])
    ->name('user.profile')
    ->whereNumber('user_id')
    ->middleware('auth')
    ->middleware('UserUrlCheck');

    // Autentificación
Route::get('/login', [App\Http\Controllers\AuthController::class, "loginForm" ])
    ->name('login');

Route::post('/login', [App\Http\Controllers\AuthController::class, "loginProcess" ])
    ->name('auth.login.process');

Route::post('/logout', [App\Http\Controllers\AuthController::class, "logoutProcess" ])
    ->name('auth.logout.process');

Route::get('/register', [App\Http\Controllers\AuthController::class, "registerForm" ])
    ->name('auth.register.form');

Route::post('/register', [App\Http\Controllers\AuthController::class, "registerProcess" ])
    ->name('auth.register.process');
