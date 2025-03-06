<?php

use Illuminate\Support\Facades\Route;

    // landing
Route::get('/', [App\Http\Controllers\LandingController::class, "landingPage" ])
    ->name('landing.page');

Route::controller(App\Http\Controllers\ComisionesController::class)->group( function(){
        // Areas de Trabajo
    Route::get('/workspace/{user_id}', "workspace")
        ->name('espacio.trabajo')
        ->whereNumber('user_id')
        ->middleware('auth')
        ->middleware('UserUrlCheck');

    Route::get('/workspace/{user_id}/complete', 'workspaceComplete')
        ->name('espacio.completas')
        ->whereNumber('user_id')
        ->middleware('auth')
        ->middleware('UserUrlCheck');

        // Comisiones
             // Ver
    Route::get('/workspace/comision/{id}', 'comisionDetail')
        ->name('espacio.details')
        ->whereNumber('id')
        ->middleware('auth')
        ->middleware('ComissionUrlCheck');

            // Crear
    Route::get('/workspace/create', 'createComision')
        ->name('espacio.crear.form')
        ->middleware('auth');

    Route::post('/workspace/create', 'createComisionProcess')
        ->name('espacio.crear.process')
        ->middleware('auth');

            // Editar
    Route::get('/workspace/comision/editar/{id}', 'editComision')
        ->name('espacio.edit')
        ->whereNumber('id')
        ->middleware('auth')
        ->middleware('ComissionUrlCheck');

    Route::put('/workspace/comision/editar/{id}', 'editComisionProcess')
        ->name('espacio.edit.process')
        ->whereNumber('id')
        ->middleware('auth');

            // Completar
    Route::put('/workspace/comision/{id}', 'completeComisionProcess')
        ->name('espacio.details.complete')
        ->whereNumber('id')
        ->middleware('auth');

        // Eliminar
    Route::delete('/workspace/comision/{id}', 'deleteComision')
        ->name('espacio.details.delete')
        ->whereNumber('id')
        ->middleware('auth');

});

Route::controller(App\Http\Controllers\TaskController::class)->group( function(){
    // Tareas
    Route::put('/workspace/tasks/complete/{id}', 'markTaskComplete')
    ->name('task.complete')
    ->whereNumber('id')
    ->middleware('auth');

    Route::put('/workspace/tasks/incomplete/{id}', 'markTaskIncomplete')
    ->name('task.incomplete')
    ->whereNumber('id')
    ->middleware('auth');

    Route::get('/workspace/tasks/add/{id}', 'addTask')
    ->name('task.add')
    ->whereNumber('id')
    ->middleware('auth');

    Route::post('/workspace/tasks/add/{id}', 'addTaskProcess')
    ->name('task.add.process')
    ->whereNumber('id')
    ->middleware('auth');

    Route::delete('/workspace/tasks/delete/{id}', 'deleteTask')
    ->name('task.delete.process')
    ->whereNumber('id')
    ->middleware('auth');

    Route::put('/workspace/tasks/moveUp/{id}', 'moveTaskUp')
        ->name('task.moveUP')
        ->whereNumber('id')
        ->middleware('auth');

    Route::put('/workspace/tasks/moveDown/{id}', 'moveTaskDown')
        ->name('task.moveDOWN')
        ->whereNumber('id')
        ->middleware('auth');
});

Route::controller(App\Http\Controllers\NoteController::class)->group( function(){
    Route::get('/workspace/notes/add/{id}', 'addNote')
    ->name('note.add')
    ->whereNumber('id')
    ->middleware('auth');

    Route::post('/workspace/notes/add/{id}', 'addNoteProcess')
    ->name('note.add.process')
    ->whereNumber('id')
    ->middleware('auth');

    Route::get('/workspace/notes/edit/{id}', 'editNote')
    ->name('note.edit')
    ->whereNumber('id')
    ->middleware('auth');

    Route::put('/workspace/notes/edit/{id}', 'editNoteProcess')
    ->name('note.edit.process')
    ->whereNumber('id')
    ->middleware('auth');

    Route::delete('/workspace/notes/delete/{id}', 'deleteNote')
    ->name('note.delete.process')
    ->whereNumber('id')
    ->middleware('auth');
});

Route::controller(App\Http\Controllers\GalleryController::class)->group( function(){
    Route::get('/workspace/gallery/add/{id}', 'addPicture')
    ->name('picture.add')
    ->whereNumber('id')
    ->middleware('auth');

    Route::post('/workspace/gallery/add/{id}', 'addPictureProcess')
    ->name('picture.add.process')
    ->whereNumber('id')
    ->middleware('auth');

    Route::delete('/workspace/gallery/delete/{id}', 'deletePicture')
    ->name('picture.delete')
    ->whereNumber('id')
    ->middleware('auth');
});

Route::controller(App\Http\Controllers\AuthController::class)->group( function(){
        // Perfil
    Route::get('/profile/{user_id}', 'profile')
        ->name('user.profile')
        ->whereNumber('user_id')
        ->middleware('auth')
        ->middleware('UserUrlCheck');

        // Login
    Route::get('/login', 'loginForm')
        ->name('login');

    Route::post('/login', 'loginProcess')
        ->name('auth.login.process');

        // Logout
    Route::post('/logout', 'logoutProcess')
        ->name('auth.logout.process');

        // Registro
    Route::get('/register', "registerForm" )
        ->name('auth.register.form');

    Route::post('/register', "registerProcess")
        ->name('auth.register.process');
});
