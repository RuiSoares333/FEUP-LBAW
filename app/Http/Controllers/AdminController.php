<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Response;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function show()
    {
        return view('pages.admin');
    }

}
