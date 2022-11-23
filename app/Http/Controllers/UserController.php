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
        if($user->picture === 'default.png'){
          $foto = asset('storage/pictures/default.png');
        }
        else{
          $foto = asset('storage/pictures/'.$id.'/'.$user->picture);
        }
        return view('pages.profile', ['user' => $user, 'foto' => $foto]);
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
      $user->done = $request->input('done');
      $user->save();
      return $user;
    }

    public function delete(Request $request, $id)
    {
      $user = User::find($id);
      $this->authorize('delete', $user);
      $user->delete();
      return $user;
    }










}