<article id="comment_{{$comment->id}}" class="news comment container my-4 border bg-light" data-id="{{ $comment->id }}">
    <section id="comment" class="comment d-flex justify-content-between" >
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

    <section id="comment_author" class="d-flex">
    @if(Auth::check() && (($comment->author()->get()->first()->id == Auth::user()->id) || Auth::user()->isAdmin()))
        <button id="edit_comment" class="mx-2 mt-4 mb-1">Edit</button>
        <div id="com_del_text" class="disapear mt-4 mb-1 mx-2">Are you sure you want to <b>permanently</b> delete this comment? This action is <b>irreversible</b>.</div>
        <button id="delete_comment" onclick="delCommentEvent({{$comment->id}})" class="mt-4 mb-1 mx-2">Delete</button>
        <form id="del_com_form">
            <button id="conf_del_com_b" type="submit" class="disapear mt-4 mb-1 mx-2">Confirm</button>
        </form>
    @endif
</section>
</article>

