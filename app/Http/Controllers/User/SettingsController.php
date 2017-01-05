<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SettingsRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user settings form
     *
     * @return Illuminate\View\View
     */
    public function showUserSettingsForm()
    {
        return view('users.settings');
    }

    /**
     * Change the user settings
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function changeUserSettings(SettingsRequest $request)
    {
        $currentCredentials = [
            'email' => $request->user()->email,
            'password' => $request->current_password
        ];

        if (! Auth::attempt($currentCredentials)) {
            return redirect()
                ->route('settings')
                ->with('invalid-password', true);
        }

        $user = User::where(['email' => $request->user()->email])->first();
        $user->changePassword($request->new_password);

        return redirect()
            ->route('settings')
            ->with('settings-changed', true);
    }
}
