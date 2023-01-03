<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function welcome(){
        echo Auth()->user()->email;
        Mail::to(Auth()->user()->email)->send(new WelcomeMail());
        return redirect('/');
    }
}
