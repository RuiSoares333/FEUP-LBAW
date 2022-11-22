<article class="news container my-5 col border bg-light" data-id="{{ $newspost->id }}">
    <header class="row m-3 d-flex flex-row">
        <h2 class="my-auto"><a href="/news/{{ $newspost->id }}">{{ $newspost->title }}</a></h2>
        <h3 class="my-auto"><a href="/profile/{{$newspost->author()->get()->first()->id}}">{{ $newspost->author()->get()->first()->username}}</a></h3>
    </header>
    @if(!empty($newspost->image))
    <div class="row mx-3">{{ $newspost->picture}}</div>
    @endif
    <div class="row mx-3">{{ $newspost->content}}</div>
    <footer class="row mx-3 mb-3">
        <div id="vote" class="fs-1 row col-2">
            <i class="bi bi-hand-thumbs-up col-sm-2"></i>
            <i class="bi bi-hand-thumbs-down col-sm-2"></i>
            <span id="reputation" class="col-sm-8  m-auto">
                {{ $newspost->reputation }} reputation
            </span>
        </div>
        <form id="new_comment" methood="POST" class="col-10 justify-content-end">
            <input class="mx-4" type="text" name="new_comment{{ $newspost->id}}" placeholder="leave your comment here!">
            <button id="submit_comment" class="btn-submit mx-5 rounded-2" type="submit">comment</button>
        </form>
    </footer>
</article>
