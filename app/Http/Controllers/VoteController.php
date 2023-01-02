<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\NewsVote;
use App\Models\CommentVote;

class VoteController extends Controller
{
    public function newsCreate(Request $request){
        if (!Auth::check()) return response("Access Denied", 403);
        //request-> is_liked->true false, id->news
        $vote = new NewsVote;
        $vote->id_user = Auth()->user()->id;
        $vote->id_news = $request->input('id');
        $vote->is_liked = $request->input('is_liked');
        $vote->save();
        return response('Vote created', 200);
    }

    public function newsDelete(Request $request){
        if (!Auth::check()) return response("Access Denied", 403);
        //request->id_news
        $vote = NewsVote::where('id_news', $request->input('id'))->where('id_user', Auth()->user()->id)->first();
        $vote->delete();
        return response('Vote deleted', 200);
    }

    public function newsUpdate(Request $request){
        if (!Auth::check()) return response("Access Denied", 403);
        //request-> id, is_liked->true false
        $vote = NewsVote::where('id_news', $request->input('id'))->where('id_user', Auth()->user()->id)->first();
        $vote->is_liked = $request->input('is_liked');
        $vote->save();
        return response('Vote updated', 200);
    }

    public function commentCreate(Request $request){
        if (!Auth::check()) return response("Access Denied", 403);;
        //request-> is_liked->true false, id->comment
        $vote = new CommentVote;
        $vote->id_user = Auth()->user()->id;
        $vote->id_comment = $request->input('id');
        $vote->is_liked = $request->input('is_liked');
        $vote->save();
        return response('Vote created', 200);
    }

    public function commentDelete(Request $request){
        if (!Auth::check()) return response("Access Denied", 403);
        //request->id_news
        $vote = CommentVote::where('id_comment', $request->input('id'))->where('id_user', Auth()->user()->id)->first();
        $vote->delete();
        return response('Vote deleted', 200);
    }

    public function commentUpdate(Request $request){
        if (!Auth::check()) return response("Access Denied", 403);
        //request-> id, is_liked->true false
        $vote = CommentVote::where('id_comment', $request->input('id'))->where('id_user', Auth()->user()->id)->first();
        $vote->is_liked = $request->input('is_liked');
        $vote->save();
        return response('Vote updated', 200);
    }
}
