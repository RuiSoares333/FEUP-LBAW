@extends('layouts.app')
@section('title', 'Post')


@section('content')

    @include('partials.header')
    
    <header class="masthead banner">
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>

        <div class="justify-content-end">
            @include('partials.newspost', $newspost)
            <div id="comment_section" class="news-comment d-flex flex-column">
                @each('partials.comment', $comments, 'comment')
            </div>
        </div>

    </header>

@endsection
