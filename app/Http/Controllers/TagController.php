<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Tag;
use App\Models\TagProposal;

class TagController extends Controller
{
    public function show($id)
    {
        $tag = Tag::find($id);
        return view('partials.banner', ['tag' => $tag]);
    }

    public function show_top()
    {

        $top = new Tag();
        $top->top_tags();

        return view('partials.banner',compact(top));
    }

    public function createProposal(Request $request){
        if (!Auth::check()) return response("Access Denied", 401);
        $name = $request->input('name');
        $tag = Tag::where('tag_name', $name)->first();

        if($tag) return response('Tag Already Exists', 403);

        $tagP = TagProposal::where('tag_name', $name)->first();
        if($tagP){ //tag proposal exists add to proposal-user
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
                'id_tag' => $tagP->id
            ]);
        }

        return response('Proposal created', 200);
    }
}
