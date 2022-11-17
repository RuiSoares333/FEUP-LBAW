<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\News;

class NewsController extends Controller
{
    /**
     * Shows the card for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $news = News::find($id);
      $this->authorize('show', $news);
      return view('pages.news', ['news' => $news]);
    }
}
