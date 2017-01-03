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

Route::get('/signin', 'User\SigninController@showSigninForm')->name('signin');
Route::post('/signin', 'User\SigninController@signin');
Route::get('/signout', 'User\SigninController@signout')->name('signout');
Route::get('/signup', 'User\SignupController@showSignupForm')->name('signup');
Route::post('/signup', 'User\SignupController@signup');
