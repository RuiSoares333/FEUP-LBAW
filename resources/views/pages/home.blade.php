@extends('layouts.app')
@section('page-title', 'Home')
@section('content')

    @include('partials.header')
    @include('partials.banner')

    <main class="col-12 col-md-9 p-5">

        <section id="news_feed">
            @each('partials.news_post', $news, 'newspost')
        </section>
        
        <section id="users">
            @each('partials.profile_preview', $user, 'user_preview')
        </section>

    </main>
@endsection

