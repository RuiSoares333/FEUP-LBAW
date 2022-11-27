@extends('layouts.app')
@section('page-title', 'Home')
@section('content')

    @include('partials.header')
    @include('partials.banner')

    <main>
        @if(Auth::check())
            <div id="form-newspost" class="row justify-content-center">
                <form class="py-5 border bg-light rounded-2" method="POST" action="{{ route('create_news') }}" enctype="multipart/form-data">
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
            @each('partials.profilepreview', $user, 'user_preview')
        </section>
    </main>
@endsection

