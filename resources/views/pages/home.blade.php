@extends('layouts.app')
@section('page-title', 'Home')
@section('content')

    @include('partials.header')
    @include('partials.banner')
    <section id="news">
        @each('partials.newspost', $news, 'newspost')
    </section>
@endsection

