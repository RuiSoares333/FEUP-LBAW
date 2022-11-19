@extends('layouts.app')

@section('title', 'News')

@section('content')

<section id="news">
  @each('partials.newspost', $news, 'newspost')
  <article class="news_post">
    <form class="news">
      <input type="text" name="name" placeholder="new news">
    </form>
  </article>
</section>

@endsection
