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
        //$this->authorize('show', $user);
        return view('pages.profile', ['user' => $user]);
    }

    public function edit(User $user)
    {
        if (!Auth::check()) return redirect('/login');
        $this->authorize('owner', $user);

        return view('pages.edit_profile', ['user' => $user]);
    }    












}