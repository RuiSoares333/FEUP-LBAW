<article id="username-prev" data-id="{{ $user->id }}">
    <section id="picture" class="mb-3">
        <img src="{{asset('pictures/user/' . $user->picture ) }}" class="rounded-circle">
    </section>
    <section id="username" class="mb-3">
        {{ $user->username }}
    </section>
    <section id="reputation" class="mb-3 text-capitalize">
        {{ $user->reputation() }} reputation
    </section>
</article>