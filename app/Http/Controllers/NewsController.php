<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\News;

class NewsController extends Controller
{
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
      //$this->authorize('list', News::class);
      $news = News::orderBy('id')->get();
      return view('header') . view('banner') . view('pages.news', ['news' => $news]);
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
