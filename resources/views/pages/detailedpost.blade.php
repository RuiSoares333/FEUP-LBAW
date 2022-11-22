@extends('layouts.app')
@section('title', 'Post')
@section('content')

@include('partials.header')
<main>
    @include('partials.newspost', $newspost)
    <div>
        @each('partials.comment', $comments, 'comment')
    </div>
</main>

@endsection