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

Route::get('/', function () {
    return view('notes.all_notes');
})->name('all_notes')->middleware('auth');

// User routes
Route::get('/forgot-password', 'User\ForgotPasswordController@showForgotPasswordForm')
     ->name('forgot-password');
Route::post('/forgot-password', 'User\ForgotPasswordController@forgotPassword');
Route::get('/settings', 'User\SettingsController@showUserSettingsForm')
     ->name('settings');
Route::post('/settings', 'User\SettingsController@changeUserSettings');
Route::get('/signin', 'User\SigninController@showSigninForm')
     ->name('signin');
Route::post('/signin', 'User\SigninController@signin');
Route::get('/signout', 'User\SigninController@signout')
     ->name('signout');
Route::get('/signup', 'User\SignupController@showSignupForm')
     ->name('signup');
Route::post('/signup', 'User\SignupController@signup');

// Note routes
Route::get('/notes/create', 'Note\CreateController@showCreateNoteForm')
     ->name('create-note');
Route::post('/notes/create', 'Note\CreateController@createNote');
