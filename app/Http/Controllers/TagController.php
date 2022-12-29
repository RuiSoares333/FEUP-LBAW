<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    public function show($id)
    {
        $tag = Tag::find($id);
        return view('partials.banner', ['tag' => $tag]);
    }

    public function show_top()
    {

        $top = new Tag();
        $top->top_tags();

        return view('partials.banner',compact(top));
    }
}