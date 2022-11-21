@extends('layouts.app')
@section('page-title', 'Home')
@section('content')

    @include('partials.header')
    @include('partials.banner')
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

