<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;

// Guest routes
Route::group(['namespace' => 'User'], function () {
    Route::get('/signup', 'SignupController@showSignupForm')->name('signup');
    Route::post('/signup', 'SignupController@signup');

    Route::get('/signin', 'SigninController@showSigninForm')->name('signin');
    Route::post('/signin', 'SigninController@signin');

    Route::get('/forgot-password', 'ForgotPasswordController@showForgotPasswordForm')
         ->name('forgot-password');
    Route::post('/forgot-password', 'ForgotPasswordController@forgotPassword');
});

// Authenticated user routes
Route::group(['namespace' => 'User', 'middleware' => 'auth'], function () {
    Route::get('/settings', 'SettingsController@showUserSettingsForm')
         ->name('settings');
    Route::post('/settings', 'SettingsController@changeUserSettings');

    Route::get('/signout', 'SigninController@signout')->name('signout');
});

// Authenticated note routes
Route::group(['namespace' => 'Note', 'middleware' => 'auth'], function () {
    Route::get('/', 'ListController@allNotes')->name('all_notes');

    Route::get('/notes/create', 'CreateController@showCreateNoteForm')
         ->name('create-note');
    Route::post('/notes/create', 'CreateController@createNote');

    Route::get('/notes/{note}', 'ViewController@viewNote')
        ->name('note')
        ->middleware('can:view,note');

    Route::get('/notes/{note}/edit', 'EditController@showEditNoteForm')
         ->name('edit-note')
         ->middleware('can:update,note');
    Route::post('/notes/{note}/edit', 'EditController@updateNote')
         ->middleware('can:update,note');

    Route::get('/notes/{note}/delete', 'DeleteController@showConfirmation')
         ->name('delete-note')
         ->middleware('can:delete,note');
    Route::post('/notes/{note}/delete', 'DeleteController@deleteNote')
         ->middleware('can:delete,note');
});

// Authenticated pad routes
Route::group(['namespace' => 'Pad', 'middleware' => 'auth'], function () {
    Route::get('/pads/create', 'CreateController@showCreatePadForm')
         ->name('create-pad');
    Route::post('/pads/create', 'CreateController@createPad');

    Route::get('/pads/{pad}/edit', 'EditController@showEditPadForm')
         ->name('edit-pad');
    Route::post('/pads/{pad}/edit', 'EditController@updatePad');
});
