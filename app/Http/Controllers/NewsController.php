<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\News;
use App\Models\Comment;

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
      $comments = Comment::where('id_news', $id)->get();
      $this->authorize('show', $news);
      return view('pages.detailedpost', ['newspost' => $news, 'comments' => $comments]);
    }

    public function search() {
      if (request('search')) {
          $news = News::where('title', 'ilike','%'.request('search').'%')->orWhere('content', 'ilike','%'.request('search').'%')->orderBy('reputation')->get();
      }
      else {
          $news = News::orderBy('reputation')->get();
      }

      return view('pages.home', ['news' => $news]);
      }

    /**
     * Shows all News.
     * @return Response
     */
    public function list()
    {
        $news = News::orderBy('reputation')->get();
        return view('pages.home', ['news' => $news]);
    }

    /**
     * Creates a new news article.
     *
     * @return News The news created.
     */
    public function create(Request $request)
    {
      $news = new News;

      $this->authorize('create', $news);

      $news->title = $request->input('title');
      $news->content = $request->input('content');
      //$news->picture = $request->input('picture');
      $news->user_id = $request->input('id_author');
      $news->save();

      $all_news = News::get();

      return view('pages.home', ['news' => $all_news]);
    }

    public function delete(Request $request, $id)
    {
      $news = News::find($id);

      $this->authorize('delete', $news);
      $news->delete();

      return $news;
    }

  public function edit(News $news)
  {
    if (!Auth::check()) return redirect('/login');
    $this->authorize('owner', $news);

    return view('pages.edit_post', ['news' => $news]);
  }

  public function writeNewsPost(){
    return;
  }
}
