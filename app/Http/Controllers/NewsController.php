<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\News;
use App\Models\Comment;
use App\Models\Tag;

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
      $comments = Comment::where('id_news', $id)->where('id_comment', NULL)->get();

      //get reply count
      foreach($comments as $comment){
        $replies = Comment::where('id_comment', $comment->id)->get();
        $comment->replyCount = count($replies);
      }
      $comments->sortBy('reputation');
      $this->authorize('show', $news);
      return view('pages.detailed_post', ['newspost' => $news, 'comments' => $comments]);
    }

    public function rte(){
      if (!Auth::check()) return redirect('/login');
      $tags = DB::table('tag')->get();
      $tags = $tags->sortBy('tag_name');
      return view('pages.create_news', ['tags' => $tags]);
    }

    /**
     * Shows all News.
     * @return Response
     */
    public function list()
    {
        $news = News::orderBy('reputation', 'desc')->get();
        $user = array();
        return view('pages.home', ['news' => $news, 'user' => $user]);
    }

    /**
     * Creates a new news article.
     *
     * @return Response
     */
    public function create(Request $request)
    {
      $news = new News;

      $this->authorize('create', $news);

      $news->title = $request->input('title');
      $news->content = $request->input('content');
      if($request->file('picture')) {
        $file= $request->file('picture');
        $filename = $file->getClientOriginalName();
        $file-> move(public_path('pictures/news'), $filename);
        $news->picture = $filename;
      }
      $news->user_id = Auth()->user()->id;
      $news->save();

    return response()->json(["success" => true, "id" => $news->id], 200);
    }

    /**
     * Delete a news article.
     *
     * @return Response
     */
    public function delete(Request $request, $id)
    {
      $news = News::find($id);
      $this->authorize('delete', $news);
      $news->delete();

      return response()->json(["success" => true], 200);
    }

  public function update(Request $request, $id)
  {
    $news = News::find($id);
    $this->authorize('update', $news);

    $news->title = $request->input('title');
    $news->content = $request->input('content');

    if($request->file('picture')) {
      $file= $request->file('picture');
      $filename = $file->getClientOriginalName();
      $file-> move(public_path('pictures/news'), $filename);
      $news->picture = $filename;
    }
    $news->save();

    return redirect('news/'. $news->id);
  }
}
