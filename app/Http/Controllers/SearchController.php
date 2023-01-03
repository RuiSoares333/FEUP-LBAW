<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\News;
use App\Models\User;
use App\Models\NewsVote;
use App\Models\Tag;

class SearchController extends Controller 
{

    public function search(Request $request) {
        if ($request->input('search')) {
          $query = $request->input('search');
          $array = explode(" ", $query);
          foreach($array as &$word) {
            $word .= ":*";
          }
          if (count($array) > 1) {
            $query = join(" | ", $array);
          }
          else {
            $query = join("", $array);
          }
          if ($request->input('filter') == "top_news") {
            $news = News::whereRaw('tsvectors @@ to_tsquery(\'english\', ?)',  [$query])
            ->orderByRaw('ts_rank(tsvectors, to_tsquery(\'english\', ?)) DESC', [$query])
            ->orderBy('reputation', 'desc')
            ->get();
            $users = array();
            $tags = array();
          }
          else if ($request->input('filter') == "recent_news") {
            $news = News::whereRaw('tsvectors @@ to_tsquery(\'english\', ?)',  [$query])
            ->orderByRaw('ts_rank(tsvectors, to_tsquery(\'english\', ?)) DESC', [$query])
            ->orderBy('date', 'desc')
            ->get();
            $users = array();
            $tags = array();
          }
          else if ($request->input('filter') == "top_users") {
            $users = User::whereRaw('tsvectors @@ to_tsquery(\'english\', ?)',  [$query])
            ->orderByRaw('ts_rank(tsvectors, to_tsquery(\'english\', ?)) DESC', [$query])
            ->orderBy('reputation', 'desc')
            ->get();
            $news = array();
            $tags = array();
          }
          else if ($request->input('filter') == "tags") {
            $search = ucfirst($request->input('search'));
            $tags = Tag::query()->where('tag_name', 'LIKE', "%{$search}%")->get();
            $news = array();
            $users = array();
          }
        }
        else {
          if ($request->input('filter') == "top_news") {
            $news = News::orderBy('reputation', 'desc')->get();
            $users = array();
            $tags = array();
          }
          else if ($request->input('filter') == "recent_news") {
            $news = News::orderBy('date', 'desc')->get();
            $users = array();
            $tags = array();
          }
          else if ($request->input('filter') == "top_users") {
            $users = User::orderBy('reputation', 'desc')->get();
            $news = array();
            $tags = array();
          }
          else if ($request->input('filter') == "tags") {
            $tags = Tag::orderBy('tag_name', 'asc')->get();
            $news = array();
            $users = array();
          }
        }

        if(Auth::check()){
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
        }
  
        return view('pages.home', ['news' => $news, 'user' => $users, 'tags' => $tags]);
    }

}