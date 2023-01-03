@extends('layouts.app')
@section('page-title', 'Home')
@section('content')

    @include('partials.header')
    @include('partials.banner')

    <main class="col-12 col-md-12 col-lg-9 p-0 p-md-5">

        <section id="news_feed">
            @each('partials.news_post', $news, 'newspost')
        </section>

        <section id="users" class="follow-grid">
            @each('partials.profile_preview', $user, 'user_preview')
        </section>

        <section id="tags" class="follow-grid">
            @each('partials.list_tag', $tags, 'tag')
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
    function followAction(self_id, user_id){
        followButton = document.getElementsByClassName("follow_button_"+user_id);
        if (followButton[0].innerHTML == "Follow"){
            follow(self_id, user_id);
        }else{
            unfollow(self_id, user_id);
        }

        for(let i=0; i<followButton.length; i++){
            if (followButton[i].innerHTML == "Follow"){
                followButton[i].innerHTML = "Unfollow";
                followButton[i].classList.toggle('btn-dark')
                followButton[i].classList.toggle('btn-outline-dark')
            }
            else if (followButton[i].innerHTML == "Unfollow"){
                followButton[i].innerHTML = "Follow";
                followButton[i].classList.toggle('btn-dark')
                followButton[i].classList.toggle('btn-outline-dark')
            }
        }

    }

    async function follow(id1, id2){
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
    }

    async function unfollow(id1, id2){
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
    }

</script>
@endsection

