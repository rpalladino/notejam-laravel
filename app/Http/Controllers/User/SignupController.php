<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\SignupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function showSignupForm()
    {
        return view('users.signup');
    }

    public function signup(SignupRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect()
            ->route('all_notes')
            ->with('success', 'Account successfully created!');
    }
}
