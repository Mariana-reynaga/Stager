<?php

use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', [\App\Http\Controllers\HomeController::class, "homePage"])
    ->name('Stager');


Route::get('/workspace', [\App\Http\Controllers\ComisionesController::class, "workSpace"])
    ->name('workspace');

Route::get('/workspace/newComision', [\App\Http\Controllers\ComisionesController::class, 'crearComision'])
    ->name('newComm');

Route::post('/workspace/newComision', [\App\Http\Controllers\ComisionesController::class, 'processNewComision'])
    ->name('newComm.process');
