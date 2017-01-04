<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ForgotPasswordRequest;
use App\Mail\User\ForgotPasswordMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('users.forgot-password');
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where(['email' => $request->email])->first();
        $newPassword = $user->regeneratePassword();

        Mail::to($user)->send(new ForgotPasswordMail($newPassword));

        return redirect()
            ->route('forgot-password')
            ->with('password-generated', true);
    }
}
