<div>

    <section id="intro" class="mx-auto text-center border-bottom py-5">
        <section id="profile-picture" class="mb-3">
            <img src="{{asset('pictures/user/' . $user->picture ) }}" class="rounded-circle">
        </section>
        <section id="username" class="mb-3">
            {{ $user->username }}
        </section>
        <section id="reputation" class="mb-3 text-capitalize">
            {{ $user->reputation() }} reputation
        </section>

        <div id="administer" class="d-flex flex-row mx-auto">
        @if(Auth::check() and (Auth::id() == $user->id || Auth::user()->isAdmin()))
            <form id="edit" method="POST" action="{{route('edit_profile', ['id' => $user->id])}}">
                {{ csrf_field() }}
                <button class="btn btn-primary rounded-2 fw-bold" type="submit">Edit</button>
            </form>
            @if($user->id != 5)
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                            <div class="modal-body">
                                <p>Are you sure you want to <b>permanently</b> delete your account?</p> 
                                <p>This action is <b>irreversible</b>.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary fw-bold text-light" data-bs-dismiss="modal">Close</button>
                                <form id="delete_form" method="POST" action="{{ route('delete_user', ['id' => $user->id]) }}">
                                    {{ csrf_field() }}
                                    <button id="delete_confirm" class="btn btn-primary fw-bold" type="submit"> Confirm Delete </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        </div>

    </section>

    <section id="follows" class="d-flex flex-row border-bottom mx-auto mb-5 py-5">
        <section id="following" class="text-center d-flex flex-column border bg-light rounded-2">
            <p class="h6">Following</p>
            <a class="h3" ref="/following">{{count($user->following()->get())}}</a>
        </section>
        <section id="followers" class="text-center d-flex flex-column border bg-light rounded-2 ml-5 mr-auto">
            <p class="h6">Followers</p>
            <a class="h3" href="/followers">{{count($user->followers()->get())}}</a>
        </section>
    </section>

    <section id="news">
        @each('partials.news_post', $user->news()->get(), 'newspost')
    </section>

</div>
