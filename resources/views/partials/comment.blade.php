<article id="comment_{{$comment->id}}" class="news comment container my-4 border bg-light" data-id="{{ $comment->id }}">
    <div id="comment_disapear">
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
    </div>

    @if(Auth::check() && (($comment->author()->get()->first()->id == Auth::user()->id) || Auth::user()->isAdmin()))
    <form id="edit_comment_form" class="disapear" method="POST" action="{{route('edit_comment')}}">
        {{ csrf_field() }}
        <input type="hidden" name="id" value={{$comment->id}}>
        <input type="text" name="content" placeholder="{{$comment->content}}" class="w-75 py-2 mt-2">
        <button id="submit_comment_edit" class="btn btn-outline-dark btn-submit mx-5 rounded-2" type="submit">Confirm Changes</button>
    </form>
    @endif

    <div id="comment_footer" class = "d-flex">
    @if(Auth::check() && (($comment->author()->get()->first()->id == Auth::user()->id) || Auth::user()->isAdmin()))
        <section id="comment_author" class="d-flex">
            <button id="edit_comment" class="mx-2 mt-4 mb-1" onclick="editCommentEvent({{$comment->id}})">Edit</button>

            <div id="com_del_text" class="disapear mt-4 mb-1 mx-2">Are you sure you want to <b>permanently</b> delete this comment? This action is <b>irreversible</b>.</div>
            <button id="delete_comment" onclick="delCommentEvent({{$comment->id}})" class="mt-4 mb-1 mx-2">Delete</button>
            <form id="del_com_form" method="POST" action="{{route('del_comment')}}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value={{$comment->id}}>
                <button id="conf_del_com_b" type="submit" class="disapear mt-4 mb-1 mx-2">Confirm</button>
            </form>

        </section>
    @endif
        <button id="reply_toggle" class="mt-4 mb-1 mx-2" onclick="toggleReply({{$comment->id}})">Reply</button>
    </div>

    <div id="reply_form" class="disapear">
        {{ csrf_field() }}
        <input id="reply_field" name="content" placeholder="Type your reply" autocomplete=off required=true>
        <button id="reply submit" type="submit" onclick="sendReply({{$comment->id}}, {{Auth::user()->id}}, {{Auth::user()->isAdmin()}})"> Reply </button>
    </div>

    <section id="replies" class="replies">
        <input type="hidden" id="reply_flag_{{$comment->id}}" value="0" autocomplete=off>
        <p id="repliesUp" onclick="toggleReplies({{$comment->id}}, {{Auth::user()->id}}, {{Auth::user()->isAdmin()}})"> Show Replies ▼</p>
        <div id="repliesDiv" class="disapear">
            <p id="repliesDown" onclick="toggleReplies({{$comment->id}}, {{Auth::user()->id}}, {{Auth::user()->is_admin}})"> Hide Replies ▲<p>
        </div>
    </section>
</article>

