@extends('layouts.app')
@section('page-title', 'Home')
@section('content')

    @include('partials.header')
    @include('partials.banner')

    <main>

        <section id="news">
            @each('partials.newspost', $news, 'newspost')
        </section>
        
        <section id="users">
            @each('partials.profilepreview', $user, 'user_preview')
        </section>

    </main>
@endsection

