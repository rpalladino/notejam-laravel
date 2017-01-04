<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Generate a new password for the user and persist as a hash
     *
     * @return string The users's new password
     */
    public function regeneratePassword()
    {
        $newPassword = bin2hex(random_bytes(8));

        $this->password = Hash::make($newPassword);
        $this->save();

        return $newPassword;
    }
}
