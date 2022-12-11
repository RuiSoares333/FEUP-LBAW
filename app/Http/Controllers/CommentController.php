<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Comment;

class CommentController extends Controller
{
    public function create(Request $request){
        $comment = new Comment;

        $this->authorize('create', $comment);

        $comment->content = $request->input('content');

        $news_id = $request->input('news_id');

        $comment->id_news = $news_id;
        $comment->user_id = Auth()->user()->id;
        $comment->id_comment = NULL;
        $comment->save();

        return redirect('news/'.$news_id);
    }
}
