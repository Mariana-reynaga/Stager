<?php

use Illuminate\Support\Facades\Route;

    // landing
Route::get('/', [App\Http\Controllers\LandingController::class, "landingPage" ])
    ->name('landing.page');

    // Comisiones
Route::controller(App\Http\Controllers\ComissionsController::class)->group( function(){
        // Areas de Trabajo
    Route::get('/workspace/{user_id}', "workspace")
        ->name('espacio.trabajo')
        ->whereNumber('user_id')
        ->middleware(['auth', 'UserUrlCheck', 'verified']);

    Route::get('/workspace/{user_id}/complete', 'workspaceComplete')
        ->name('espacio.completas')
        ->whereNumber('user_id')
        ->middleware(['auth', 'UserUrlCheck', 'verified']);

        // Comissions
             // Ver
    Route::get('/workspace/comision/{id}', 'comisionDetail')
        ->name('espacio.details')
        ->whereNumber('id')
        ->middleware(['auth', 'verified', 'ComissionUrlCheck']);

            // Crear
    Route::get('/workspace/create', 'createComision')
        ->name('espacio.crear.form')
        ->middleware(['auth', 'verified', 'PlanCheckCreateCom']);

    Route::post('/workspace/create', 'createComisionProcess')
        ->name('espacio.crear.process')
        ->middleware('auth');

            // Editar
    Route::get('/workspace/comision/editar/{id}', 'editComision')
        ->name('espacio.edit')
        ->whereNumber('id')
        ->middleware(['auth', 'ComissionUrlCheck', 'verified']);

    Route::put('/workspace/comision/editar/{id}', 'editComisionProcess')
        ->name('espacio.edit.process')
        ->whereNumber('id')
        ->middleware('auth');

            // Completar
    Route::put('/workspace/comision/{id}', 'completeComisionProcess')
        ->name('espacio.details.complete')
        ->whereNumber('id')
        ->middleware('auth');

            // Incompletar
    Route::put('/workspace/comision/incomplete/{id}', 'incompleteComissionProcess')
        ->name('espacio.details.incomplete')
        ->whereNumber('id')
        ->middleware('auth');

        // Eliminar
    Route::delete('/workspace/comision/{id}', 'deleteComision')
        ->name('espacio.details.delete')
        ->whereNumber('id')
        ->middleware('auth');

        // Subir Recibo
    Route::get('/workspace/comision/reciept/{id}', 'uploadReciept')
        ->name('reciept.upload')
        ->whereNumber('id')
        ->middleware(['auth', 'ComissionUrlCheck', 'verified']);

    Route::post('/workspace/comision/reciept/{id}', 'uploadRecieptProcess')
        ->name('reciept.upload.process')
        ->whereNumber('id')
        ->middleware(['auth', 'ComissionUrlCheck', 'verified']);

        // Descargar Recibo
    Route::get('/workspace/comision/reciept/download/{id}', 'downloadReciept')
        ->name('reciept.download')
        ->whereNumber('id')
        ->middleware(['auth', 'ComissionUrlCheck', 'verified']);

        // Eliminar Recibo
    Route::delete('/workspace/comision/reciept/delete/{id}','deleteReciept')
        ->name('reciept.delete')
        ->whereNumber('id')
        ->middleware(['auth', 'ComissionUrlCheck', 'verified']);
});

    // Tareas
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

    // Notas
Route::controller(App\Http\Controllers\NoteController::class)->group( function(){
    Route::get('/workspace/notes/add/{id}', 'addNote')
    ->name('note.add')
    ->whereNumber('id')
    ->middleware(['auth', 'PlanCheckCreateNote']);

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

    // Galeria
Route::controller(App\Http\Controllers\GalleryController::class)->group( function(){
    Route::get('/workspace/gallery/add/{id}', 'addPicture')
    ->name('picture.add')
    ->whereNumber('id')
    ->middleware(['auth', 'PlanCheckCreateImg']);

    Route::post('/workspace/gallery/add/{id}', 'addPictureProcess')
    ->name('picture.add.process')
    ->whereNumber('id')
    ->middleware(['auth', 'PlanCheckUploadImg']);

    Route::delete('/workspace/gallery/delete/{id}', 'deletePicture')
    ->name('picture.delete')
    ->whereNumber('id')
    ->middleware('auth');
});

    // Autentificación
Route::controller(App\Http\Controllers\AuthController::class)->group( function(){
        // Perfil
    Route::get('/profile/{user_id}', 'profile')
        ->name('user.profile')
        ->whereNumber('user_id')
        ->middleware('auth')
        ->middleware('UserUrlCheck');

        // Editar Datos
    Route::get('/profile/edit/{user_id}', 'editProfile')
        ->name('user.edit')
        ->whereNumber('user_id')
        ->middleware(['auth', 'UserUrlCheck']);

    Route::put('/profile/edit/user/{user_id}', 'editUser')
        ->name('user.edit.process')
        ->whereNumber('user_id')
        ->middleware(['auth', 'UserUrlCheck']);

    Route::put('/profile/edit/password/{user_id}', 'editPassword')
        ->name('password.edit.process')
        ->whereNumber('user_id')
        ->middleware(['auth', 'UserUrlCheck']);

    Route::put('/profile/edit/image/{user_id}', 'editImage')
        ->name('user.image.edit')
        ->whereNumber('user_id')
        ->middleware(['auth', 'UserUrlCheck']);

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

        // Alerta Verificar email
    Route::get('/email/notice', 'verifyNotice')
        ->name('verification.notice')
        ->middleware('auth');

        // Verificador de email
    Route::get('/email/{id}/{hash}', 'verifyEmail')
    ->name('verification.verify')
    ->middleware(['auth', 'signed']);

        // Re-enviar verificación de email
    Route::post('/email/verification-notification', 'resendVerify')
    ->name('verification.send')
    ->middleware(['auth', 'throttle:6,1']);

});
