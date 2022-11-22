<article class="news container my-4 d-flex border bg-light" data-id="{{ $comment->id }}">
    <h4 class="my-auto">{{$comment -> content}}</h4>
    <h4 class="my-auto">{{$comment -> user_id}}</h4>
    <div id="vote" class="fs-1 d-flex col-2 justify-content-end">
        <i class="bi bi-hand-thumbs-up"></i>
        <i class="bi bi-hand-thumbs-down"></i>
        <span id="reputation" class="m-auto">
            {{ $comment->reputation }} reputation
        </span>
    </div>
</article>