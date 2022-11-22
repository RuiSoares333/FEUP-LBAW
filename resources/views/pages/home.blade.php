@extends('layouts.app')
@section('page-title', 'Home')
@section('content')

    @include('partials.header')
    @include('partials.banner')
    <form class="input-group my-3 h2">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input class="form-control text-light" type="search" placeholder="What are you looking for?" name="search" value="{{ request('search') }}">
    </form>
    <div id="form-newspost" class="my-5 row justify-content-center">
        <form class="py-5 border bg-light rounded-2">
            <input class="mx-3" type="text" name="new_news_post" placeholder="share your article here!">
            <button id="submit_comment" class="btn-submit mx-3 rounded-2" type="submit">submit</button>
        </form>
    </div>
    <section id="news">
        @each('partials.newspost', $news, 'newspost')
    </section>
@endsection

