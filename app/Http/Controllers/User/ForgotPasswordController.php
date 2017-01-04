<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\User\ForgotPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('users.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $user = User::where(['email' => $request->email])->first();
        $newPassword = $user->regeneratePassword();

        Mail::to($user)->send(new ForgotPassword($newPassword));

        return redirect()
            ->route('forgot-password')
            ->with('password-generated', true);
    }
}
