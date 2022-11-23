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
      if (!Auth::check()) return redirect('/login');
      $news = News::find($id);
      $comments = Comment::where('id_news', $id)->get();
      $this->authorize('show', $news);
      return view('pages.detailedpost', ['newspost' => $news, 'comments' => $comments]);
    }

    /**
     * Shows all News.
     * @return Response
     */
    public function list()
    {
        $news = News::orderBy('reputation')->get();
        $user = array();
        return view('pages.home', ['news' => $news, 'users' => $user]);
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
      $file= $request->file('picture');
      $filename = $file->getClientOriginalName();
      $file-> move(public_path('pictures/news'), $filename);
      $news->picture = $filename;
      $news->user_id = $request->input('id_author');
      $news->save();

      return redirect('news/'. $news->id);
    }

    public function delete(Request $request, $id)
    {
      $news = News::find($id);
      $this->authorize('delete', $news);
      $news->delete();

      $all_news = News::get();
      return view('pages.home', ['news' => $all_news]);
    }

  public function update(Request $request, $id)
  {
    $news = News::find($id);
    $this->authorize('update', $news);

    $news->title = $request->input('title');
    $news->content = $request->input('content');
    $file= $request->file('picture');
    $filename = $file->getClientOriginalName();
    $file-> move(public_path('pictures/news'), $filename);
    $news->picture = $filename;
    $news->save();

    return redirect('news/'. $news->id);
  }
}
