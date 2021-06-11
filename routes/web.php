<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [MessageController::class, 'index'])->name('index');
    Route::get('/admin', [MessageController::class, 'admin'])->name('admin');
    Route::post('/send', [MessageController::class, 'send'])->name('send');
    Route::get('/list', [MessageController::class, 'list'])->name('list');
    Route::delete('/list/{id}', [MessageController::class, 'destroy'])->name('delete');
    Route::get('/sync', [MessageController::class, 'sync'])->name('sync');

    Route::get('/send-image', [MessageController::class, 'showImageForm'])->name('showImageForm');
    Route::post('/send-image', [MessageController::class, 'sendImage'])->name('sendImage');

    Route::get('/send-video', [MessageController::class, 'showVideoForm'])->name('showVideoForm');
    Route::post('/send-video', [MessageController::class, 'sendVideo'])->name('sendVideo');

    Route::get('/create-user', [MessageController::class, 'showcreateUserForm'])->name('showcreateUserForm');
    Route::post('/create-user', [MessageController::class, 'createUser'])->name('createUser');

    Route::get('/check-passsword', [MessageController::class, 'checkPasssword'])->name('checkPasssword');
    // Route::get('/change-token', [MessageController::class, 'showTokenForm'])->name('showTokenForm');
    // Route::post('/change-token', [MessageController::class, 'changeToken'])->name('changeToken');

});