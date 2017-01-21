<?php

namespace App\Policies;

use App\Pad;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the pad.
     *
     * @param  \App\User  $user
     * @param  \App\Pad  $pad
     * @return mixed
     */
    public function view(User $user, Pad $pad)
    {
        return $user->id === $pad->user_id;
    }

    /**
     * Determine whether the user can create pads.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the pad.
     *
     * @param  \App\User  $user
     * @param  \App\Pad  $pad
     * @return mixed
     */
    public function update(User $user, Pad $pad)
    {
        return $user->id === $pad->user_id;
    }

    /**
     * Determine whether the user can delete the pad.
     *
     * @param  \App\User  $user
     * @param  \App\Pad  $pad
     * @return mixed
     */
    public function delete(User $user, Pad $pad)
    {
        return $user->id === $pad->user_id;
    }
}
