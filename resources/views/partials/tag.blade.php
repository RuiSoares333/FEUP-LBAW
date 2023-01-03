<div>
    <section id="intro" class="mx-auto text-center border-bottom py-5">
        <section id="tag_name" class="mb-3">
            {{ $tag->tag_name }}
        </section>

                    @if(Auth::check())
                <form id="_tag" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_user" name="id_user" value={{ Auth::id() }}>
                    <input type="hidden" id="id_tag" name="id_tag" value={{ $tag->id }}>
                    @if(!Auth::user()->check_follow_tag(Auth::id(), $user->id))
                    <button id="follow_button" class="btn btn-outline-dark" type="button">Follow</button>
                    @else
                    <button id="follow_button" class="btn btn-dark" type="button">Unfollow</button>
                    @endif
                </form>
    </section>

        <section id="followers" class="text-center d-flex flex-column py-2 px-4 border bg-light rounded-2 ms-5 me-auto">
            <p class="h6">Followers</p>
            {{count($tag->followers()->get())}}
        </section>
    </section>

    @endif
    <section id="news">
        @each('partials.news_post', $news, 'newspost')
    </section>

</div>

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
            followButton.classList.toggle('btn-outline-dark')        }
    });
    async function follow_tag(){
        let id_user = document.getElementById("id_user").value;
        let id_tag = document.getElementById("id_tag").value;
        const response = await fetch("/api/follow_tag", {
            method: 'post',
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                'csrf-token': document.querySelector('meta[name="csrf-token"]').content,
                'id_user': id_user,
                'id_tag': id_tag
            })
        });
        const replies = await response.json();
        followButton.innerHTML = "Unfollow";
    }

    async function unfollow_tag(){
        let id_user = document.getElementById("id_user").value;
        let id_tag = document.getElementById("id_tag").value;
        const response = await fetch("/api/unfollow_tag", {
            method: 'delete',
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                'csrf-token': document.querySelector('meta[name="csrf-token"]').content,
                'id_user': id_user,
                'id_tag': id_tag
            })
        });
        const replies = await response.json();
        followButton.innerHTML = "Follow";
    }
/*
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
    */
</script>
