@extends('layouts.app')
@section('page-title', 'Follows')
@section('content')

    @include('partials.header')

    <div id="carouselExampleIndicators" class="carousel slide follows col-10 mx-auto" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active justify-content-center" data-bs-interval="999999">
                <h1 class="fw-bold text-light text-center" >Following</h1>
                <div class="follow-grid">
                    @each('partials.profile_preview', $user->following()->get(), 'user_preview')
                </div>
            </div>
            <div class="carousel-item justify-content-center" data-bs-interval="999999">
                <h1 class="fw-bold text-light text-center">Followers</h1>
                <div class="follow-grid">
                    @each('partials.profile_preview', $user->followers()->get(), 'user_preview')
                </div>
            </div>
        </div>
        <button class="carousel-control-prev position-fixed top-50 start-0 translate-middle-y" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next position-fixed top-50 end-0 translate-middle-y" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

@endsection

@section('scripts')

<script>
    document.body.style.background = "linear-gradient(0deg, #bf6324 0%, #b92a4c 100%)";
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