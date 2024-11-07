<?php

use Illuminate\Support\Facades\Route;

    // landing page
Route::get('/', [\App\Http\Controllers\HomeController::class, "homePage"])
    ->name('Stager');

    //  Comisiones incompletas
Route::get('/workspace', [\App\Http\Controllers\ComisionesController::class, "workSpace"])
    ->name('workspace');

    // Comisiones completadas
Route::get('/completed', [\App\Http\Controllers\ComisionesController::class, "completedWorkspace"])
    ->name('completed.workspace');

    // Crear nuevas comisiones
Route::get('/workspace/newComision', [\App\Http\Controllers\ComisionesController::class, 'crearComision'])
    ->name('newComm');

Route::post('/workspace/newComision', [\App\Http\Controllers\ComisionesController::class, 'processNewComision'])
    ->name('newComm.process');
