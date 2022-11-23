@extends('layouts.app')
@section('page-title', 'Home')
@section('content')

    @include('partials.header')
    @include('partials.banner')
    <form class="input-group my-5 mx-auto p-5 h2 border bg-light rounded-2" action="{{ route('search') }}">
        <button type="submit" class="input-group-text"><i class="bi bi-search"></i></button>
        <input id="search-bar" class="form-control" type="search" placeholder="What are you looking for?" name="search" value="{{ request('search') }}">
    </form>
    @if(Auth::check())
        <div id="form-newspost" class="row justify-content-center">
            <form class="py-5 border bg-light rounded-2" method="POST" action="{{ route('create_news') }}">
                {{ csrf_field() }}
                <h1>Create News</h1>
                <input class="new_news_input" type="text" name="title" placeholder="News Title">
                tags
                <textarea rows="10" cols="60" class="new_news_input"  type="text" name="content" placeholder="News Content"></textarea>
                <input type="file" name="picture" accept="image/png, image/jpeg" />
                <input type="hidden" name="id_author" value={{Auth::user()->id}}>
                <button id="submit_comment" class="btn-submit mx-3 rounded-2" type="submit">submit</button>
            </form>
        </div>
    @endif

    <section id="news">
        @each('partials.newspost', $news, 'newspost')
    </section>
    <section id="users">
        @each('partials.user', $users, 'user_preview')
    </section>
@endsection

