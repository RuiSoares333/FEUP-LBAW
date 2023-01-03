<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use App\Mail\RecoverMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class EmailController extends Controller
{
    public function welcome(){
        Mail::to(Auth()->user()->email)->send(new WelcomeMail());
        return redirect('/');
    }

    public function recover(Request $request){
        $user = User::firstWhere('email', $request->email);
        if($user != null){
            Mail::to($user->email)->send(new RecoverMail());

            if($request->input('email') != ""){
                $user->email = $request->input('email');
            }
        
            if($request->input('password') != ""){
                $user->password = bcrypt($request->input('password'));
            }
        }
        return redirect('/login');
    }
}
