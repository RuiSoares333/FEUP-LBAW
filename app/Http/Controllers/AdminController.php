<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Tag;
use App\Models\TagProposal;
use App\Models\News;

class AdminController extends Controller
{
    public function show()
    {
        if(Auth::check() && Auth::user()->isAdmin()){
            $accepted_tag_proposals = TagProposal::where('is_handled', true)->get();
            $tag_proposals = TagProposal::where('is_handled', false)->get();
        
            return view('pages.admin', ['tag_proposals' => $tag_proposals, 'accepted_tag_proposals' => $accepted_tag_proposals]);
        }
        else return redirect('/');
    }

}
