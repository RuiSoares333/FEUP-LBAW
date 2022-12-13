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

    public function delete(Request $request){
        $comment = Comment::find($request->input('id'));
        $this->authorize('delete', $comment);
        $news_id = $comment->news()->get()->first()->id;
        $comment->delete();
        return redirect('news/'.$news_id);
    }

    public function edit(Request $request){
        $comment = Comment::find($request->input('id'));
        $this->authorize('delete', $comment);
        $news_id = $comment->news()->get()->first()->id;
        $comment->content = $request->input('content');
        $comment->save();
        return redirect('news/'.$news_id);
    }

    public function getReplies(Request $request){
        $id = $request->input('id');
        $replies = Comment::where('id_comment', $id)->get();
        $replies->sortBy('reputation');
        return response()->json($replies, 200);
    }
}
