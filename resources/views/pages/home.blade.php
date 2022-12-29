@extends('layouts.app')
@section('page-title', 'Home')
@section('content')

    @include('partials.header')
    @include('partials.banner')

    <main class="col-12 col-md-12 col-lg-9 p-0 p-md-5">

        <section id="news_feed">
            @each('partials.news_post', $news, 'newspost')
        </section>
        
        <section id="users">
            @each('partials.profile_preview', $user, 'user_preview')
        </section>

    </main>
@endsection


@section('scripts')
<script>
    const news = document.getElementsByClassName("news_content")
    for(var post of news){
        var images = post.querySelectorAll("img")
        for(var i=0; i < images.length; i++){
            const parNode = images[i].parentNode
            parNode.removeChild(images[i])
        }
    }
</script>
@endsection

