@extends('layouts.app')
@section('title', 'Post')
@section('content')

@include('partials.header')

<article class="news container my-5 col border bg-light" data-id="{{ $news->id }}">
    <header class="row my-3 mx-3">
        <h2><a href="/news/{{ $news->id }}">{{ $news->title }}</a></h2>
        <h3><a href="/news/{{ $news->id }}">{{ $news->author()->get()->first()->username}}</a></h3>
    </header>
    @if(!empty($news->image))
    <div class="row mx-3">{{ $news->picture}}</div>
    @else
    <div class="row mx-3">{{ $news->content}}</div>
    @endif
    <footer class="row mx-3 mb-3">
        <div id="vote" class="fs-1 row col-2">
            <i class="bi bi-hand-thumbs-up col-sm-2"></i>
            <i class="bi bi-hand-thumbs-down col-sm-2"></i>
            <span id="reputation" class="col-sm-8  m-auto">
                {{ $news->reputation }} reputation
            </span>
        </div>
        <form id="new_comment" methood="POST" class="col-10 justify-content-end">
            <input class="mx-4" type="text" name="new_comment{{ $news->id}}" placeholder="leave your comment here!">
            <button id="submit_comment" class="btn-submit mx-5 rounded-2" type="submit">comment</button>
        </form>
    </footer>
</article>