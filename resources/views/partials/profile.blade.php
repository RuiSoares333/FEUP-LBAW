<div>
    <section id="intro" class="mx-auto text-center border-bottom py-5">
        <section id="profile-picture" class="mb-3">
            <img src="{{asset('pictures/user/' . $user->picture ) }}" class="rounded-circle col-6 col-lg-3">
        </section>
        <section id="username" class="mb-3">
            {{ $user->username }}
        </section>
        <section id="reputation" class="mb-3 text-capitalize">
            <span class="reputation">{{ $user->reputation() }}</span> reputation
        </section>

        <div id="administer" class="d-flex flex-column mx-auto">
        @if(Auth::check() and (Auth::id() == $user->id || Auth::user()->isAdmin()))
            <form id="edit" method="POST" class="mb-2" action="{{route('edit_profile', ['id' => $user->id])}}">
                {{ csrf_field() }}
                <button class="btn btn-primary rounded-2 fw-bold" type="submit">Edit</button>
            </form>
            @if($user->id != 5)
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary fw-bold col-4 col-lg-2 mx-auto" data-bs-toggle="modal" data-bs-target="#exampleModal" id = "trigger_delete">
                    Delete Account
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p>Are you sure you want to <b>permanently</b> delete your account?</p> 
                                <p>This action is <b>irreversible</b>.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary fw-bold text-light" data-bs-dismiss="modal">Close</button>
                                <form id="delete_form" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="delete_id" name="user_id" value = {{$user->id}}>
                                    <button id="delete_confirm" class="btn btn-primary fw-bold" type="button"> Confirm Delete </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        </div>

    </section>

    <section id="follows" class="d-flex flex-row border-bottom mb-5 py-5">
        <section id="following" class="text-center d-flex flex-column py-2 px-4 border bg-light rounded-2 me-5 ms-auto">
            <p class="h6">Following</p>
            <a class="h3" ref="/following">{{count($user->following()->get())}}</a>
        </section>
        <section id="followers" class="text-center d-flex flex-column py-2 px-4 border bg-light rounded-2 ms-5 me-auto">
            <p class="h6">Followers</p>
            <a class="h3" href="/followers">{{count($user->followers()->get())}}</a>
        </section>
    </section>

    @if(Auth::check() and (Auth::id() != $user->id))
    <form id="follow_form" method="POST">
        {{ csrf_field() }}
        <input type="hidden" id="id1" name="id1" value={{ Auth::id() }}>
        <input type="hidden" id="id2" name="id2" value={{ $user->id }}>
        @if(!Auth::user()->check_follow(Auth::id(), $user->id))
        <button id="follow_button" class="btn btn-primary fw-bold" type="button">Follow</button>
        @else
        <button id="follow_button" class="btn btn-primary fw-bold" type="button">Unfollow</button>
        @endif
    </form>
    @endif
    <section id="news">
        @each('partials.news_post', $user->news()->get(), 'newspost')
    </section>

</div>

<script>

    followButton = document.getElementById("follow_button");
    followButton.addEventListener("click", function() {
        if (followButton.innerHTML == "Follow") follow();
        else if (followButton.innerHTML == "Unfollow") unfollow();
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

    triggerDeleteButton = document.getElementById("trigger_delete");
    triggerDeleteButton.addEventListener("click", triggerDelete);
    function triggerDelete() {
        var deleteUserButton = document.getElementById("delete_confirm");
        deleteUserButton.addEventListener("click", deleteUser);
    }

    async function deleteUser(){
        let id = document.getElementById("delete_id").value
        const response = await fetch("/api/delete_profile/"+id, {
            method: 'delete',
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                'csrf-token': document.querySelector('meta[name="csrf-token"]').content,
                'id': id
            })
        });
        const replies = await response.json();
        window.location.href = '/';
    }
</script>
