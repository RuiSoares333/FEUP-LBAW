<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\News;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\NewsVote;
use App\Models\CommentVote;

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
      $vote = NewsVote::where('id_user', Auth()->user()->id)->where('id_news', $id)->first();

      if(!$vote){
        $news -> isLiked = 0;
      }
      else if($vote->is_liked == TRUE){
        $news-> isLiked = 1;
      }
      else if($vote->is_liked == FALSE){
        $news -> isLiked = -1;
      }

      $comments = Comment::where('id_news', $id)->where('id_comment', NULL)->get();

      //get reply count
      foreach($comments as $comment){
        $replies = Comment::where('id_comment', $comment->id)->get();
        $comment->replyCount = count($replies);
        $comment->hasReplies = $comment->replyCount !== 0;

        $vote = CommentVote::where('id_user', Auth()->user()->id)->where('id_comment', $comment->id)->first();
            if(!$vote){
                $comment -> isLiked = 0;
            }
            else if($vote->is_liked == TRUE){
                $comment-> isLiked = 1;
            }
            else if($vote->is_liked == FALSE){
                $comment -> isLiked = -1;
            }
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
      $news = News::orderBy('date', 'desc')->get();

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

      $user = array();
      $tags = array();
      return view('pages.home', ['news' => $news, 'user' => $user, 'tags' => $tags]);
    }

    public function userFeedList()
    {
        if(!Auth::check()) return redirect('/');

        //get tag_follows
        $newsIds = DB::select('select id from (news inner join (select id_news from (tag_follow inner join news_tag on tag_follow.id_tag = news_tag.id_tag) where id_user = ?) as sub on news.id = sub.id_news)', [Auth::user()->id]);

        $news = array();

        foreach($newsIds as $newsId){
            $item = News::find($newsId->id);
            array_push($news, $item);
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

      $user = array();
      $tags = array();
      return view('pages.home', ['news' => $news, 'user' => $user, 'tags' => $tags]);
    }

    public function listBy(Request $request)
    {
      if ($request->input('filter') == "top") {
        $news = News::orderBy('reputation', 'desc')->get();
        $users = array();
        return view('pages.home', ['news' => $news, 'user' => $users]);
      }
      else if ($request->input('filter') == "recent") {
        $news = News::orderBy('date', 'desc')->get();
        $users = array();
        return view('pages.home', ['news' => $news, 'user' => $users]);
      }
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

      $id_news = $news->id;

      foreach ($request->input('tags',[]) as $tag_name) {
        try {
            DB::table('tag')->insertOrIgnore([['tag_name' => $tag_name]]);

            $id_tag = Tag::firstWhere('tag_name', $tag_name)->id;
            DB::table('news_tag')->insert(['id_news' => $id_news, 'id_tag' => $id_tag]);
        } catch (ValidationException $e) {
            DB::rollBack();
            return back()->withErrors(['dberror' => $e->getMessage()])->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
      DB::commit();

      return redirect('news/'. $news->id);
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

  public function update(Request $request)
  {
    $id = $request->input('news_post_id');
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


    //Remove old tags
    foreach ($news->tags as $tag) {
      if (!in_array($tag->name, $request->input('tags'))) {
          try {
              DB::table('news_tag')->where(['id_news' => $news->id, 'id_tag' => $tag->id])->delete();
          } catch (ValidationException $e) {
              DB::rollBack();
              return back()->withErrors(['dberror' => $e->getMessage()])->withInput();
          } catch (\Exception $e) {
              DB::rollBack();
              throw $e;
          }
      }
    }


    $id_news = $news->id;

    foreach ($request->input('tags',[]) as $tag_name) {
      try {
          DB::table('tag')->insertOrIgnore([['tag_name' => $tag_name]]);

          $id_tag = Tag::firstWhere('tag_name', $tag_name)->id;
          DB::table('news_tag')->insert(['id_news' => $id_news, 'id_tag' => $id_tag]);
      } catch (ValidationException $e) {
          DB::rollBack();
          return back()->withErrors(['dberror' => $e->getMessage()])->withInput();
      } catch (\Exception $e) {
          DB::rollBack();
          throw $e;
      }
    }

    DB::commit();

    return redirect('news/'. $news->id);
  }


  public function edit($id){
    if (!Auth::check()) return redirect('/login');

    $news = News::find($id);
    $tags = DB::table('tag')->get();
    $tags = $tags->sortBy('tag_name');

    $this->authorize('show', $news);

    foreach($tags as $tag){
      $tag->checked = false;
      foreach($news->tags as $newstag){
        if($tag->id === $newstag->id){
          $tag->checked = true;
        }
      }
    }

    return view('pages.edit_news', ['newspost' => $news, 'tags' => $tags]);
  }
}
