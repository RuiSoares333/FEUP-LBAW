<article id="user-prev" class="mx-auto my-5 py-3 d-flex flex-row border bg-light rounded-2" data-id="{{ $user_preview->id }}">
    <section id="profile-picture">
        <img src="{{asset('pictures/user/' . $user_preview->picture ) }}" class="rounded-circle">
    </section>
    <a id="username" href="/profile/{{$user_preview->id}}">{{ $user_preview->username }}</a>
    <section id="reputation" class="reputation text-capitalize">
        <span class="reputation">{{ $user_preview->reputation() }}</span> reputation
    </section>
</article>