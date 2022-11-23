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
            $word .= ":* ";
          }
          $query = join(" | ", $array);
          $news = News::whereRaw('tsvectors @@ to_tsquery(\'english\', ?)',  [$query])
          ->orderByRaw('ts_rank(tsvectors, to_tsquery(\'english\', ?)) DESC', [$query])
          ->orderBy('reputation', 'desc')
          ->get();
          $users = User::whereRaw('tsvectors @@ to_tsquery(\'english\', ?)',  [$query])
          ->orderByRaw('ts_rank(tsvectors, to_tsquery(\'english\', ?)) DESC', [$query])
          ->orderBy('reputation', 'desc')
          ->get();
        }
        else {
          $news = News::orderBy('reputation')->get();
          $users = User::orderBy('reputation')->get();
        }
  
        return view('pages.home', ['news' => $news, 'users' => $users]);
    }

}