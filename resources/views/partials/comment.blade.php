<article class="news comment container my-4 border bg-light" data-id="{{ $comment->id }}">
    <section id="comment" class=" d-flex">
        <h4 class="my-auto">{{$comment -> content}}</h4>
        <h4 class="my-auto">{{$comment->author()->get()->first()->username}}</h4>
        <div id="vote" class="fs-1 d-flex col-2 justify-content-end">
            <i class="bi bi-hand-thumbs-up"></i>
            <i class="bi bi-hand-thumbs-down"></i>
            <span id="reputation" class="m-auto">
                {{ $comment->reputation }} reputation
            </span>
        </div>
    </section>

    <script>
    </script>

    <section id="comment_author">
    @if(Auth::check() && (($comment->author()->get()->first()->id == Auth::user()->id) || Auth::user()->isAdmin()))
        <button id="edit_comment">Edit</button>
        <button id="delete_comment">Delete</button>
    @endif
</section>
</article>

