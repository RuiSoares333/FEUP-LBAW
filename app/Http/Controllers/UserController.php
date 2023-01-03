<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\News;
use App\Models\NewsVote;

class UserController extends Controller
{
    public function show($id)
    {
        if (!Auth::check()) return redirect('/login');
        $user = User::find($id);
        $news = $user->news()->get();
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
        return view('pages.profile', ['user' => $user, 'news' => $news]);
    }

    public function edit($id)
    {
        if (!Auth::check()) return redirect('/login');
        $user = User::find($id);
        $this->authorize('owner', $user);
        return view('pages.edit_profile', ['user' => $user]);
    }


    public function create(Request $request, $user_id)
    {
      $user = new User();
      $user->user_id = $user_id;
      $this->authorize('create', $user);
      $user->done = false;
      $user->description = $request->input('description');
      $user->save();
      return $user;
    }

    public function update(Request $request)
    {
      $user = User::find($request->id);
      $this->authorize('update', $user);
      $user->username = $request->input('username');
      $user->country = $request->input('country');

      if($request->file('picture')) {
        $file= $request->file('picture');
        $filename = $file->getClientOriginalName();
        $file-> move(public_path('pictures/user/'.$user->id), $filename);
        $user->picture = $filename;
      }

      if($request->input('email') != ""){
        $user->email = $request->input('email');
      }

      if($request->input('password') != ""){
        $user->password = bcrypt($request->input('password'));
      }

      $user->save();
      return redirect('profile/' . $user->id);
    }

    public function delete($id)
    {
      $user = User::find($id);
      $this->authorize('owner', $user);
      $user->delete();
      return response()->json(["success" => true], 200);
    }

    public function change_admin($id){
      $user = User::find($id);
      $this->authorize('admin', $user);
      $user->is_admin = !($user->is_admin);

      $user->save();
      return redirect('profile/' . $user->id);
    }

    public function follow(Request $request) {
      DB::table('follows')->insert(['id1' => $request->id1, 'id2' => $request->id2]);
      return response()->json(["success" => true], 200);
    }

    public function unfollow(Request $request) {
      DB::delete('DELETE FROM follows WHERE id1 = ? AND id2 = ?', [$request->id1, $request->id2]);
      return response()->json(["success" => true], 200);
    }

    public function follow_list(Request $request, $id){
      if (!Auth::check()) return redirect('/login');
      $user = User::find($id);
      return view('pages.follow_list', ['user' => $user]);
    }

    public function recoverPassword(){
      return view('pages.recover_password');
    }
}
