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
            images[i].classList.toggle('img-fluid')
        }
    }
</script>


<script>
    followButton = document.getElementById("follow_button");
    followButton.addEventListener("click", function() {
        if (followButton.innerHTML == "Follow"){
            follow();
            followButton.classList.toggle('btn-dark')
            followButton.classList.toggle('btn-outline-dark')
        }
        else if (followButton.innerHTML == "Unfollow"){
            unfollow();
            followButton.classList.toggle('btn-dark')
            followButton.classList.toggle('btn-outline-dark')
        }
    });
    async function follow(){
        let id1 = document.getElementById("id1").value;
        let id2 = document.getElementById("id2").value;
        const response = await fetch("/api/follow", {
            method: 'post',
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                'csrf-token': document.querySelector('meta[name="csrf-token"]').content,
                'id1': id1,
                'id2': id2
            })
        });
        const replies = await response.json();
        followButton.innerHTML = "Unfollow";
    }

    async function unfollow(){
        let id1 = document.getElementById("id1").value;
        let id2 = document.getElementById("id2").value;
        const response = await fetch("/api/unfollow", {
            method: 'delete',
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                'csrf-token': document.querySelector('meta[name="csrf-token"]').content,
                'id1': id1,
                'id2': id2
            })
        });
        const replies = await response.json();
        followButton.innerHTML = "Follow";
    }

</script>
@endsection

