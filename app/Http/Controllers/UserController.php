<?php   

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

class UserController extends Controller 
{

    public function show(User $user)
    {
        $user = User::find($id);
        $this->authorize('show', $user);
        return view('pages.profile', ['user' => $user]);
    }












}