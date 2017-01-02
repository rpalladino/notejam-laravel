<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function showSignupForm()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        $request->merge([
            'password' => password_hash($request->password, PASSWORD_BCRYPT)
        ]);
        $user = User::create($request->toArray());

        return redirect()
            ->route('all_notes')
            ->with('signup_success', 'Account successfully created!');
    }
}
