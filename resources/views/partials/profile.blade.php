<header class="masthead banner d-flex flex-column">
    <section id="intro" class="text-center border-bottom py-5">
        <section id="picture" class="mb-3">
            <img src="https://picsum.photos/id/237/200/300" class="rounded-circle">
        </section>
        <section id="username" class="mb-3">
            {{ $user->username }}
        </section>
        <section id="reputation" class="mb-3 text-capitalize">
            {{ $user->reputation() }} reputation
        </section>

        @if(Auth::check() and Auth::id() == $user->id)
        <a href="{{ route('edit_profile',['id' => $user->id])}}"><button type="submit">Edit</button></a>
        @endif
    </section>

    <section id="follows" class="d-flex flex-row border-bottom mb-5 py-5">
        <section id="following" class="text-center border bg-light rounded-2">
            <p>Following</p>
            @if(!empty($user->following()->get()))
            @each('partials.user', $user->following()->get(), 'user')
            @else
            <p>no users being followed</p>
            @endif
        </section> 
        <section id="followers" class="text-center border bg-light rounded-2 ml-5 mr-auto">
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