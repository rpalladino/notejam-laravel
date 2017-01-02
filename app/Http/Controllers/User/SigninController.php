<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SigninRequest;
use Illuminate\Support\Facades\Auth;

class SigninController extends Controller
{
    public function showSigninForm()
    {
        return view('signin');
    }

    public function signin(SigninRequest $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended();
        }
    }
}
