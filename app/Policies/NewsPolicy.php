<?php

namespace App\Policies;

use App\Models\User;
use App\Models\News;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class NewsPolicy
{
    use HandlesAuthorization;

    public function show(User $user, News $news)
    {
      return Auth::check();
    }

    public function create(User $user)
    {
      // Any user can create a new news
      return Auth::check();
    }

    public function delete(User $user, News $news)
    {
      // Only a news owner or admin can delete it
      if($user->is_admin) return true;
      return $user->id == $news->user_id;
    }

    public function author(User $user, News $news)
    {
        if($user->is_admin) return true;
        return $user->id === $news->user_id;
    }

    public function update(User $user, News $news)
    {
      // Only a news owner or admin can update it
      if($user->is_admin) return true;
      return $user->id == $news->user_id;
    }

}

//para update
