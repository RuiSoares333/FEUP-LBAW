<article class="news" data-id="{{ $newspost->id }}">
    <header>
        <h2><a href="/news/{{ $newspost->id }}">{{ $newspost->title }}</a></h2>
        <a href="#" class="delete">&#10761;</a>
    </header>
    <span>{{ $newspost->content }}</span>
    <span>{{ $newspost->reputation }}</span>
</article>
