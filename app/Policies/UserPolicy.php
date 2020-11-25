<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the profile.
     *
     * @param  \App\User  $user
     * @param  \App\User  $signedInUSer
     * @return mixed
     */
    public function update(User $user, User $signedInUSer)
    {
        return $signedInUSer->id === $user->id;
    }
}
