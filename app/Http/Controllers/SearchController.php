<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\News;
use App\Models\User;

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
          if ($request->input('filter') == "top") {
            $news = News::whereRaw('tsvectors @@ to_tsquery(\'english\', ?)',  [$query])
            ->orderByRaw('ts_rank(tsvectors, to_tsquery(\'english\', ?)) DESC', [$query])
            ->orderBy('reputation', 'desc')
            ->get();
          }
          else if ($request->input('filter') == "recent") {
            $news = News::whereRaw('tsvectors @@ to_tsquery(\'english\', ?)',  [$query])
            ->orderByRaw('ts_rank(tsvectors, to_tsquery(\'english\', ?)) DESC', [$query])
            ->orderBy('date', 'desc')
            ->get();
          }
          /*$users = User::whereRaw('tsvectors @@ to_tsquery(\'english\', ?)',  [$query])
          ->orderByRaw('ts_rank(tsvectors, to_tsquery(\'english\', ?)) DESC', [$query])
          ->orderBy('reputation', 'desc')
          ->get();*/
        }
        else {
          if ($request->input('filter') == "top") {
            $news = News::orderBy('reputation', 'desc')->get();
          //$users = User::orderBy('reputation')->get();
          }
          else if ($request->input('filter') == "recent") {
            $news = News::orderBy('date', 'desc')->get();
          }
        }
  
        return view('pages.home', ['news' => $news, 'user' => array()]);
    }

}