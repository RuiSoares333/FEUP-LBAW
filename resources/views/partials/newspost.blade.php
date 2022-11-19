<article class="newspost" data-id="{{ $newspost->id }}">
    <header>
        <h2><a href="/news/{{ $newspost->id }}">{{ $newspost->title }}</a></h2>
        <a href="#" class="delete">&#10761;</a>
    </header>
    <ul>
    @each('partials.item', $newspost->items()->orderBy('id')->get(), 'item')
    </ul>
</article>
