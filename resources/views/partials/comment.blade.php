<article id="comment_{{$comment->id}}" class="news col-xl-8 my-4 p-3 border bg-light" data-id="{{ $comment->id }}">
    <section id="comment" class="comment" >
        <section id="author_tools" class="d-flex flex-row justify-content-between">
            <p class="col-xl-11 mb-1">{{$comment->author()->get()->first()->username}}</p>

            @if(Auth::check() && (($comment->author()->get()->first()->id == Auth::user()->id) || Auth::user()->isAdmin()))
                <button id="delete_button" class="btn edit-button" data-bs-toggle="modal" data-bs-target="#commentModal-{{ $comment->id }}"><i class="bi bi-trash"></i></button>
                <button id="toggle_edit" class="btn edit-button" onclick="displayEditForm()"><i class="bi bi-pencil"></i></button>
            @endif
        </section>

        <h4 class="my-auto ms-3">{{$comment -> content}}</h4>
    </section>

    @if(Auth::check() && (($comment->author()->get()->first()->id == Auth::user()->id) || Auth::user()->isAdmin()))
        <form id="edit_comment_form" style="display: none" method="POST" action="{{route('edit_comment')}}">
            {{ csrf_field() }}
            <input type="hidden" name="id" value={{$comment->id}}>
            <input type="text" name="content" placeholder="{{$comment->content}}" class="w-75 py-2 mt-2">
            <button id="submit_comment_edit" class="btn btn-outline-dark btn-submit mx-5 rounded-2" type="button">Confirm Changes</button>
        </form>
    @endif

    <div id="comment_footer" class = "d-flex flex-row">
        <div id="comment_vote_{{$comment->id}}" class="d-flex flex-row me-3">
            <input id="comment_is_liked_{{$comment->id}}" type="hidden" value={{$comment->isLiked}} autocomplete=off>
            @if($comment->isLiked == 1)
                <button class="mx-auto bi bi-caret-up-fill cursor-pointer" style="font-size: 2rem; background-color: rgb(255, 255, 255); border: medium hidden; color:orange;" onclick="commentVoteUp({{$comment->id}}, {{Auth::user()->id}})"></button>
            @else
                <button class="mx-auto bi bi-caret-up cursor-pointer" style="font-size: 2rem; background-color: rgb(255, 255, 255); border: medium hidden;" onclick="commentVoteUp({{$comment->id}}, {{Auth::user()->id}})"></button>
            @endif

            <span id="reputation" class="w-auto m-auto">
                {{ $comment->reputation }}
            </span>

            @if($comment->isLiked == -1)
                <button class="mx-auto bi bi-caret-down-fill cursor-pointer" style="font-size: 2rem; background-color: rgb(255, 255, 255); border: medium hidden; color:orange;" onclick="commentVoteDown({{$comment->id}}, {{Auth::user()->id}})"></button>
            @else
                <button class="mx-auto bi bi-caret-down cursor-pointer"style="font-size: 2rem; background-color: rgb(255, 255, 255); border: medium hidden;" onclick="commentVoteDown({{$comment->id}}, {{Auth::user()->id}})"></button>
            @endif
        </div>

        <button id="reply_toggle_{{$comment->id}}" class="btn edit-button mx-3" onclick="toggleReply({{$comment->id}})"><i class='bi bi-arrow-90deg-right'></i></button>


        <section id="replies" class="replies" @if(!($comment->hasReplies)) style="display:none"  @endif>
            <input type="hidden" id="reply_flag_{{$comment->id}}" value="0" autocomplete=off>
            <button id="showReplies" class="btn edit-button mx-3" onclick="toggleReplies({{$comment->id}}, {{Auth::user()->id}}, {{Auth::user()->isAdmin()}})">Show Replies</button>
            <button id="hideReplies" class="btn edit-button mx-3" style="display:none" onclick="toggleReplies({{$comment->id}}, {{Auth::user()->id}}, {{Auth::user()->is_admin}})">Hide Replies</button>
        </section>
    </div>

    <div id="reply_form_{{ $comment->id }}" style="display: none">
        <div id="new_comment" class="input-group">
            <div class="input-group mb-3">
                <input id="reply_field" class="form-control" name="content" placeholder="Type your reply" autocomplete=off required=true>
                <button id="reply submit" class="btn btn-outline-dark btn-submit" type="button" onclick="sendReply({{$comment->id}}, {{Auth::user()->id}}, {{Auth::user()->isAdmin()}})"> Reply </button>
            </div>
        </div>
    </div>

    <div id="repliesDiv-{{$comment->id}}">

    </div>

<script>
    newCommentModal = `
        <!-- Modal -->
        <div class="modal fade" id="commentModal-`+{{ $comment->id }}+`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p>Are you sure you want to <b>permanently</b> delete this comment?</p>
                        <p>This action is <b>irreversible</b>.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary fw-bold text-light" data-bs-dismiss="modal">Close</button>
                        <form id="delete_comment_`+{{$comment->id}}+`" method="POST" action="{{route('del_comment')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="`+{{$comment->id}}+`">
                            <button type="button" class="btn btn-primary fw-bold" onclick="delCommentEvent(`+{{$comment->id}}+`, `+{{$comment->reputation}}+`, `+{{$comment->replyCount}}+`)"> Confirm Delete </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        `
        commentModals = document.getElementById('commentModals')
        commentModals.innerHTML = commentModals.innerHTML + newCommentModal
</script>



</article>
