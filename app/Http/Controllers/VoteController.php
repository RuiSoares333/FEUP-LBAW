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
        if (!Auth::check()) return response("Access Denied", 401);
        //request-> is_liked->true false, id->news
        DB::table('news_vote')->insert([
            'id_user' => Auth()->user()->id,
            'id_news' => $request->input('id'),
            'is_liked' => $request->input('is_liked')
        ]);


        return response('Vote created', 200);
    }

    public function newsDelete(Request $request){
        if (!Auth::check()) return response("Access Denied", 401);
        //request->id_news
        DB::table('news_vote')
            ->where('id_news', $request->input('id'))
            ->where('id_user', Auth()->user()->id)
            ->delete();
        return response('Vote deleted', 200);
    }

    public function newsUpdate(Request $request){
        if (!Auth::check()) return response("Access Denied", 401);
        //request-> id, is_liked->true false
        DB::table('news_vote')
            ->where('id_news', $request->input('id'))
            ->where('id_user', Auth()->user()->id)
            ->update(['is_liked' => $request->input('is_liked')]);
        return response('Vote updated', 200);
    }

    public function commentCreate(Request $request){
        if (!Auth::check()) return response("Access Denied", 401);;
        //request-> is_liked->true false, id->comment
        DB::table('comment_vote')->insert([
            'id_user' => Auth()->user()->id,
            'id_comment' => $request->input('id'),
            'is_liked' =>$request->input('is_liked')
        ]);
        return response('Vote created', 200);
    }

    public function commentDelete(Request $request){
        if (!Auth::check()) return response("Access Denied", 401);
        //request->id_news
        DB::table('comment_vote')
            ->where('id_comment', $request->input('id'))
            ->where('id_user', Auth()->user()->id)
            ->delete();
        return response('Vote deleted', 200);
    }

    public function commentUpdate(Request $request){
        if (!Auth::check()) return response("Access Denied", 401);
        //request-> id, is_liked->true false
        DB::table('comment_vote')
            ->where('id_comment', $request->input('id'))
            ->where('id_user', Auth()->user()->id)
            ->update(['is_liked' => $request->input('is_liked')]);
        return response('Vote updated', 200);
    }
}
