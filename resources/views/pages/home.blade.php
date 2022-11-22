@extends('layouts.app')
@section('page-title', 'Home')
@section('content')

    @include('partials.header')
    @include('partials.banner')
    <form class="input-group my-3 h2" action="{{ route('search') }}">
        <button type="submit" class="input-group-text"><i class="bi bi-search"></i></button>
        <input class="form-control text-light" type="search" placeholder="What are you looking for?" name="search" value="{{ request('search') }}">
    </form>
    @if(auth::check())
        <div id="form-newspost" class="my-5 row justify-content-center">
            <form class="py-5 border bg-light rounded-2" method="POST" action="{{ route('create_news') }}">
                {{ csrf_field() }}
                <h1>Create News</h1>
                <input class="new_news_input" type="text" name="title" placeholder="News Title">
                tags
                <textarea rows="10" cols="60" class="new_news_input"  type="text" name="content" placeholder="News Content"></textarea>
                picture
                <input type="hidden" name="id_author" value={{Auth::user()->id}}>
                <button id="submit_comment" class="btn-submit mx-3 rounded-2" type="submit">submit</button>
            </form>
        </div>
    @endif

    <section id="news">
        @each('partials.newspost', $news, 'newspost')
    </section>
@endsection

