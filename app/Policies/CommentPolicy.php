<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
      // Any user can create a new comment
      return Auth::check();
    }

    public function delete(User $user, Comment $comment)
    {
      // Only a comment owner or admin can delete it
      if($user->is_admin) return true;
      return $user->id == $comment->user_id;
    }

    public function author(User $user, Comment $comment)
    {
        if($user->is_admin) return true;
        return $user->id === $comment->user_id;
    }
}
