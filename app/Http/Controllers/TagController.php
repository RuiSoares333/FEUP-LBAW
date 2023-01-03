<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\TagProposal;
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

    public function createProposal(Request $request){
        if (!Auth::check()) return response("Access Denied", 401);
        $name = $request->input('name');
        $tag = Tag::where('tag_name', $name)->exists();

        if($tag) return response('Tag Already Exists', 403);

        $tagP = TagProposal::where('tag_name', $name)->first();
        if($tagP){ //tag proposal exists add to proposal-user
            $propUser = DB::table('tag_proposal_user')->where('id_tag', $tagP->id)->where('id_user', Auth()->user()->id)->exists();
            if($propUser) return response('You Alreay made this Proposal', 403);

            DB::table('tag_proposal_user')->insert([
                'id_user' => Auth()->user()->id,
                'id_tag' => $tagP->id
            ]);
        }
        else{ //tag doesnt exist, create and add proposal-user
            $newProp = new TagProposal;
            $newProp->tag_name = $name;
            $newProp->save();

            DB::table('tag_proposal_user')->insert([
                'id_user' => Auth()->user()->id,
                'id_tag' => $newProp->id
            ]);
        }

        return response('Proposal created', 200);
    }

    public function createTag(Request $request){
        if(!Auth::check()) return response("Access Denied", 401);
        if(!(Auth()->user()->is_admin)) return response("Access Denied", 401);
        $proposal_id = $request->input('id');

        $proposal = TagProposal::find($proposal_id);
        $tag_name = $proposal->tag_name;

        $proposal->is_handled = TRUE;
        $proposal->save();

        $tag = new Tag;
        $tag->tag_name = $tag_name;
        $tag->save();
        //return redirect()->route('show_admin');
        return response()->json(["success" => true], 200);
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
