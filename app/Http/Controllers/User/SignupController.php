<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\SignupRequest;

class SignupController extends Controller
{
    public function showSignupForm()
    {
        return view('signup');
    }

    public function signup(SignupRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_BCRYPT)
        ]);

        return redirect()
            ->route('all_notes')
            ->with('signup_success', 'Account successfully created!');
    }
}
