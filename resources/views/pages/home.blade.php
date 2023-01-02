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
    async function newsVoteUp(id){
            const button = document.querySelector('#news_vote_'+id+' button:nth-of-type(1)')
            const isLiked = document.querySelector("#news_is_liked_" + id)
            const rep = document.querySelector('#news_vote_'+id+' #reputation')
            if(isLiked.value == 1){
                //remove like
                isLiked.value = 0
                rep.innerText = parseInt(rep.innerText)-1
                button.classList.remove("bi-caret-up-fill")
                button.classList.add("bi-caret-up")
                button.style.color=""
            }
            else if(isLiked.value == 0){
                //add Like
                isLiked.value = 1
                rep.innerText = parseInt(rep.innerText)+1
                button.classList.remove("bi-caret-up")
                button.classList.add("bi-caret-up-fill")
                button.style.color="orange"
            }
            else if(isLiked.value == -1){
                //change to like
                const down = document.querySelector('#news_vote_'+id+' button:nth-of-type(2)')
                isLiked.value = 1
                rep.innerText = parseInt(rep.innerText)+2
                button.classList.remove("bi-caret-up")
                button.classList.add("bi-caret-up-fill")
                button.style.color="orange"

                down.classList.remove("bi-caret-down-fill")
                down.classList.add("bi-caret-down")
                down.style.color=""
            }
        }
        async function newsVoteDown(id){
            const button = document.querySelector('#news_vote_'+id+' button:nth-of-type(2)')
            const isLiked = document.querySelector("#news_is_liked_" + id)
            const rep = document.querySelector('#news_vote_'+id+' #reputation')
            if(isLiked.value == 1){
                //change like
                const up = document.querySelector('#news_vote_'+id+' button:nth-of-type(1)')
                isLiked.value = -1
                rep.innerText = parseInt(rep.innerText)-2
                button.classList.remove("bi-caret-down")
                button.classList.add("bi-caret-down-fill")
                button.style.color="orange"

                up.classList.remove("bi-caret-up-fill")
                up.classList.add("bi-caret-up")
                up.style.color=""
            }
            else if(isLiked.value == 0){
                //add dislike
                isLiked.value = -1
                rep.innerText = parseInt(rep.innerText)-1
                button.classList.remove("bi-caret-down")
                button.classList.add("bi-caret-down-fill")
                button.style.color="orange"
            }
            else if(isLiked.value == -1){
                //remove dislike
                isLiked.value = 0
                rep.innerText = parseInt(rep.innerText)+1
                button.classList.remove("bi-caret-down-fill")
                button.classList.add("bi-caret-down")
                button.style.color=""
            }
        }
        async function commentVoteUp(id){
            const isLiked = document.querySelector("#comment_is_liked_" + id)
            const button = document.querySelector('#comment_vote_'+id+' button:nth-of-type(1)')
            const rep = document.querySelector('#comment_vote_'+id+' #reputation')
            if(isLiked.value == 1){
                //remove like
                isLiked.value = 0
                rep.innerText = parseInt(rep.innerText)-1
                button.classList.remove("bi-caret-up-fill")
                button.classList.add("bi-caret-up")
                button.style.color=""
            }
            else if(isLiked.value == 0){
                //add Like
                isLiked.value = 1
                rep.innerText = parseInt(rep.innerText)+1
                button.classList.remove("bi-caret-up")
                button.classList.add("bi-caret-up-fill")
                button.style.color="orange"
            }
            else if(isLiked.value == -1){
                //change to like
                const down = document.querySelector('#comment_vote_'+id+' button:nth-of-type(2)')
                isLiked.value = 1
                rep.innerText = parseInt(rep.innerText)+2
                button.classList.remove("bi-caret-up")
                button.classList.add("bi-caret-up-fill")
                button.style.color="orange"
                down.classList.remove("bi-caret-down-fill")
                down.classList.add("bi-caret-down")
                down.style.color=""
            }
        }
        async function commentVoteDown(id){
            const isLiked = document.querySelector("#comment_is_liked_" + id)
            const button = document.querySelector('#comment_vote_'+id+' button:nth-of-type(2)')
            const rep = document.querySelector('#comment_vote_'+id+' #reputation')
            if(isLiked.value == 1){
                //change like
                const up = document.querySelector('#comment_vote_'+id+' button:nth-of-type(1)')
                isLiked.value = -1
                rep.innerText = parseInt(rep.innerText)-2
                button.classList.remove("bi-caret-down")
                button.classList.add("bi-caret-down-fill")
                button.style.color="orange"

                up.classList.remove("bi-caret-up-fill")
                up.classList.add("bi-caret-up")
                up.style.color=""
            }
            else if(isLiked.value == 0){
                //add dislike
                isLiked.value = -1
                rep.innerText = parseInt(rep.innerText)-1
                button.classList.remove("bi-caret-down")
                button.classList.add("bi-caret-down-fill")
                button.style.color="orange"
            }
            else if(isLiked.value == -1){
                //remove dislike
                isLiked.value = 0
                rep.innerText = parseInt(rep.innerText)+1
                button.classList.remove("bi-caret-down-fill")
                button.classList.add("bi-caret-down")
                button.style.color=""
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

