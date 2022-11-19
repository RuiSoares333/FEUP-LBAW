@extends('layouts.app')

@section('title', 'News')

@section('content')

<section id="news">
  @each('partials.card', $news, 'news')
  <article class="news">
    <form class="new_news">
      <input type="text" name="name" placeholder="new news">
    </form>
  </article>
</section>

@endsection
