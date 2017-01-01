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
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect()->route('signup');
});

Route::get('/signup', function (Request $request) {
    return view('signup');
})->name('signup');

Route::post('/signup', function (Request $request) {
    $user = new User();
    $user->email = $request->email;
    $user->password = $request->password;
    $user->save();

    return redirect()
        ->route('signin')
        ->with('signup_success', 'Account successfully created!');
});

Route::get('/signin', function () {
    return view('signin');
})->name('signin');
