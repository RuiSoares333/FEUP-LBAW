<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagProposal extends Model
{
    public $timestamps = false;

    protected $table = 'tag_proposal';

    protected $fillable = [
        'tag_name',
        'description'
    ];


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

}



