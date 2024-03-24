<?php

use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserNoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('alreadyloggedin');

Route::get('/user/register', [UserAuthController::class, 'register'])
    ->middleware('alreadyloggedin')
    ->name('user.register');

Route::post('/user/register/post', [UserAuthController::class, 'post_register'])
    ->name('resigter.post');

Route::post('/user/login/post', [UserAuthController::class, 'login'])
    ->name('user.login');

Route::get('dashboard', [UserAuthController::class, 'dashboard'])
    ->middleware('isLoggedIn')
    ->name('user.dashboard');

Route::get('logout', [UserAuthController::class, 'logout'])
    ->name('user.logout');

// Frontend routes
Route::get('create_note', [UserNoteController::class, 'create_note'])
    ->name('user.create_note');

Route::post('note/post', [UserNoteController::class, 'note_post'])
    ->name('create.note');

Route::put('/notes/{id}', [UserNoteController::class, 'updateNote'])
    ->name('notes.update');

Route::delete('/notes/{id}', [UserNoteController::class, 'destroy'])
    ->name('note.destroy');

Route::get('/notes/search', [UserNoteController::class, 'search'])
    ->name('notes.search');

require __DIR__.'/auth.php';
