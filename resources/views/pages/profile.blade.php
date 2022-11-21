@extends('layouts.app')
@section('title', 'Profile')
@section('content')

    @include('partials.header')
    <section id="picture">
        {{ $user->picture }}
    </section>
    <section id="username">
        {{ $user->username }}
    </section>
    <section id="reputation">
        {{ $user->reputation() }}
    </section>
    <section id="news">
        @each('partials.newspost', $user->news()->get(), 'newspost')
    </section>
    <section id="following">
        <p>Following</p>
        @each('partials.user', $user->following()->get(), 'user')
    <section id="followers">
        <br>
        <p>Followers</p>
        @each('partials.user', $user->followers()->get(), 'user')
    </section> 

@endsection

