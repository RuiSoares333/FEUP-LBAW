<article class="news container my-5 col border bg-light" data-id="{{ $newspost->id }}">
    <header class="row my-3 mx-3">
        <h2><a href="/news/{{ $newspost->id }}">{{ $newspost->title }}</a></h2>
    </header>
    @if(!empty($newspost->image))
    <div class="row mx-3">{{ $newspost->picture}}</div>
    @else
    <div class="row mx-3">{{ $newspost->content}}</div>
    @endif
    <footer class="row mx-3 mb-3">
        <div id="vote" class="fs-1 row col-2">
            <i class="bi bi-hand-thumbs-up col-sm-2"></i>
            <i class="bi bi-hand-thumbs-down col-sm-2"></i>
            <span id="reputation" class="col-sm-8  m-auto">
                {{ $newspost->reputation }} reputation
            </span>
        </div>
        <form id="new_comment" action="post" class="col-10 justify-content-end">
            <input class="mx-4" type="text" name="new_comment{{ $newspost->id}}" placeholder="leave your comment here!">
            <input id="submit_comment" class="mx-5" type="submit" value="comment">
        </form>
    </footer>
</article>
