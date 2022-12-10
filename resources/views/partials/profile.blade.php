<header class="masthead banner d-flex flex-column">
    <div class="bg-circle-1 bg-circle"></div>
    <div class="bg-circle-2 bg-circle"></div>
    <div class="bg-circle-3 bg-circle"></div>
    <div class="bg-circle-4 bg-circle"></div>

    <section id="intro" class="text-center border-bottom py-5">
        <section id="profile-picture" class="mb-3">
            <img src="{{asset('pictures/user/' . $user->picture ) }}" class="rounded-circle">
        </section>
        <section id="username" class="mb-3">
            {{ $user->username }}
        </section>
        <section id="reputation" class="mb-3 text-capitalize">
            {{ $user->reputation() }} reputation
        </section>

        <div id="administer" >
        @if(Auth::check() and (Auth::id() == $user->id || Auth::user()->isAdmin()))
            @if(Auth::user()->isAdmin() && Auth::id() == $user->id)
            <form id="change" method="POST" action="{{route('change_admin', ['id' => $user->id])}}">
                {{ csrf_field() }}
                <button type="submit">Revoke Admin</button>
            </form>
            @elseif(Auth::user()->isAdmin() && !($user->is_admin))
            <form id="change" method="POST" action="{{route('change_admin', ['id' => $user->id])}}">
                {{ csrf_field() }}
                <button type="submit">Make</button>
            </form>
            @endif
        <form id="edit" method="POST" action="{{route('edit_profile', ['id' => $user->id])}}">
            {{ csrf_field() }}
            <button type="submit">Edit</button>
        </form>

        <section id="delete_user">
            <script>
                function deleteButtonEvent(){
                    const delB1 = document.querySelector('#delete_button')
                    const delB2 = document.querySelector("#delete_form")
                    const confT = document.querySelector("#confirm_text")
                    delB2.classList.toggle('disapear')
                    confT.classList.toggle('disapear')
                    if(delB1.innerText=="Cancel"){
                        delB1.innerText="Delete"
                    }
                    else{
                        delB1.innerText="Cancel"
                    }
                }
            </script>
            <p id="confirm_text" class="disapear"> Are you sure you want to <b>permanently</b> delete your account? This action is <b>irreversible</b>.</p>
            <div class="d-flex flex-row justify-content-center">
                <button id="delete_button" class="btn-submit mx-3 rounded-2" onclick="deleteButtonEvent()">Delete</button>
                <form id="delete_form" class="disapear" method="POST" action="{{ route('delete_user', ['id' => $user->id]) }}">
                    {{ csrf_field() }}
                    <button id="delete_confirm" class="btn-submit mx-3 rounded-2" type="submit"> Confirm Delete </button>
                </form>
            </div>
        </section>

        @endif
        </div>

    </section>

    <section id="follows" class="d-flex flex-row border-bottom mb-5 py-5">
        <section id="following" class="text-center d-flex flex-column border bg-light rounded-2">
            <p>Following</p>
            @if(!empty($user->following()->get()))
            @each('partials.user', $user->following()->get(), 'user')
            @else
            <p>no users being followed</p>
            @endif
        </section>
        <section id="followers" class="text-center d-flex flex-column border bg-light rounded-2 ml-5 mr-auto">
            <p>Followers</p>
            @if(!empty($user->followers()->get()))
            @each('partials.user', $user->followers()->get(), 'user')
            @else
            <p>no followers</p>
            @endif
        </section>
    </section>

    <section id="news">
        @each('partials.newspost', $user->news()->get(), 'newspost')
    </section>

</header>
