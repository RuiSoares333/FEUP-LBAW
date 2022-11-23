<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

class UserController extends Controller
{
    public function show($id)
    {
        if (!Auth::check()) return redirect('/login');
        $user = User::find($id);
        return view('pages.profile', ['user' => $user]);
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

    public function update(Request $request, $id)
    {
      $user = User::find($id);
      $this->authorize('update', $user);
      $user->username = $request->input('username');
      $user->country = $request->input('country');

      if($request->file('picture')) {
        $file= $request->file('picture');
        $filename = $file->getClientOriginalName();
        $file-> move(public_path('pictures/user'), $filename);
        $user->picture = $filename;
      }

      if($request->input('email') != ""){
        $user->email = $request->input('email');
      }

      if($request->input('password') != ""){
        $user->password = Hash::make($request->input('password'));
      }

      $user->save();
      return redirect('profile/' . $user->id);
    }

    public function delete(Request $request, $id)
    {
      $user = User::find($id);
      $this->authorize('delete', $user);
      $user->delete();
      return $user;
    }

    public function change_admin($id){
      $user = User::find($id);
      $this->authorize('admin', $user);
      $user->is_admin = !($user->is_admin);

      $user->save();
      return redirect('profile/' . $user->id);
    }

}
