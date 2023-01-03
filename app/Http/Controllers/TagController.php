<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\NewsVote;

class TagController extends Controller
{

    public function show($id)
    {
        if (!Auth::check()) return redirect('/login');
        $user = Auth()->user();
        $tag = Tag::find($id);
        $news = $tag->news()->get();
        foreach($news as $item){
            $vote = NewsVote::where('id_user', Auth()->user()->id)->where('id_news', $item->id)->first();

            if(!$vote){
                $item -> isLiked = 0;
            }
            else if($vote->is_liked == TRUE){
                $item-> isLiked = 1;
            }
            else if($vote->is_liked == FALSE){
                $item -> isLiked = -1;
            }
        }
        return view('pages.tag', ['tag' => $tag, 'news' => $news, 'user' => $user]);
    }


/*
    public function show($id)
    {
        $tag = Tag::find($id);
        return view('partials.banner', ['tag' => $tag]);
    }
*/
    public function show_top()
    {

        $top = new Tag();
        $top->top_tags();

        return view('partials.banner',compact(top));
    }

    public function follow_tag(Request $request) {
        DB::table('tag_follow')->insert(['id_user' => $request->id_user, 'id_tag' => $request->id_tag]);
        return response()->json(["success" => true], 200);
      }
  
      public function unfollow_tag(Request $request) {
        DB::delete('DELETE FROM tag_follow WHERE id_user = ? AND id_tag = ?', [$request->id_user, $request->id_tag]);
        return response()->json(["success" => true], 200);
      }
}