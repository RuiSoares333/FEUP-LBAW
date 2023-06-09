<?php

namespace App\Policies;

use App\Models\User;
use App\Models\News;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy {

    public function owner(User $user_logged, User $user)
    {
        if($user_logged->is_admin) return true;
        return $user_logged->id === $user->id;
    }

    public function update(User $user_logged, User $user)
    {
        if($user_logged->is_admin) return true;
        return $user_logged->id === $user->id;
    }

    public function admin(User $user_logged, User $user)
    {
        return $user_logged->is_admin;
    }
}
