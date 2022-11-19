@extends('layouts.app')

@section('title', 'News')

@section('content')

<section id="news">
  @each('partials.newspost', $news, 'newspost')
</section>

@endsection
