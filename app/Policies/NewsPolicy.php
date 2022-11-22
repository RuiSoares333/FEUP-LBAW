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
      // Only a news owner can delete it
      return $user->id == $news->user_id;
    }

    public function author(User $user, News $news)
    {
        return $user->id === $news->id_author;
    }

}

//para update
