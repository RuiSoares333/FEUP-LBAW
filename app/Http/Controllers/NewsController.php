<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\News;

class NewsController extends Controller
{

    /*
    id SERIAL PRIMARY KEY,
    reputation INTEGER NOT NULL DEFAULT 0,
    title TEXT NOT NULL,
    content TEXT NOT NULL,
    date TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    picture TEXT,
    id_author INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE
    */

    /**
     * Shows the news for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $news = News::find($id);
      $this->authorize('show', $news);
      return view('pages.news', ['news' => $news]);
    }

    /**
     * Shows all News.
     * @return Response
     */
    public function list()
    {
      if (!Auth::check()) return redirect('/login');
      $this->authorize('list', News::class);
      $news = Auth::user()->news()->orderBy('reputation')->get();
      return view('pages.news', ['news' => $news]);
    }

    /**
     * Creates a new news article.
     *
     * @return News The news created.
     */
    public function create(Request $request)
    {
      $news = new News();

      $this->authorize('create', $news);

      $news->title = $request->input('title');
      $news->content = $request->input('content');
      $news->picture = $request->input('picture');
      $news->id_author = Auth::user()->id;
      $news->save();

      return $news;
    }

    public function delete(Request $request, $id)
    {
      $news = News::find($id);

      $this->authorize('delete', $news);
      $news->delete();

      return $news;
    }
}
