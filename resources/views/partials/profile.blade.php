<header class="masthead banner d-flex flex-column">
    <div class="bg-circle-1 bg-circle"></div>
    <div class="bg-circle-2 bg-circle"></div>
    <div class="bg-circle-3 bg-circle"></div>
    <div class="bg-circle-4 bg-circle"></div>

    <section id="intro" class="text-center border-bottom py-5">
        <section id="picture" class="mb-3">
            <img src="{{$foto}}" class="rounded-circle">
        </section>
        <section id="username" class="mb-3">
            {{ $user->username }}
        </section>
        <section id="reputation" class="mb-3 text-capitalize">
            {{ $user->reputation() }} reputation
        </section>

        @if(Auth::check() and (Auth::id() == $user->id || Auth::user()->isAdmin()))
        <form method="POST" action="{{route('edit_profile', ['id' => $user->id])}}">
            {{ csrf_field() }}
            <button type="submit">Edit</button>
        </form>
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
