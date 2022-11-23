<article id="username-prev" data-id="{{ $user_preview->id }}">
    <section id="picture" class="mb-3">
        <img src="{{asset('pictures/user/' . $user_preview->picture ) }}" class="rounded-circle">
    </section>
    <section id="username" class="mb-3">
        {{ $user_preview->username }}
    </section>
    <section id="reputation" class="mb-3 text-capitalize">
        {{ $user_preview->reputation() }} reputation
    </section>
</article>