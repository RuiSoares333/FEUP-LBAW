@extends('layouts.app')
@section('title', 'Post')


@section('content')

    @include('partials.header')

    <div id="commentModals">
        
    </div>
    
    <div class="justify-content-end">
        @include('partials.news_post', $newspost)
        <div id="comment_section" class="news-comment d-flex flex-column">
            @each('partials.comment', $comments, 'comment')
        </div>
    </div>

    <div id="replyModals">

    </div>

@endsection

@section('scripts')

    <script>
        async function deleteNews(id){
            const response = await fetch("/api/news/"+id, {
                method: 'delete',
                headers:{
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    'csrf-token': document.querySelector('meta[name="csrf-token"]').content,
                    'id': id
                })
            });
            const replies = await response.json();
            window.location.href = '/';
        }

        function deleteButtonEvent(id){
            const comments = document.querySelector("#comment_section")
            if({{$newspost->reputation}} !== 0){
                alert('A news item with reputation cannot be deleted.')
            }else if(comments.childNodes.length > 1){
                alert("A news item with comments cannot be deleted.")
            }else{
                var deleteNewsButton = document.getElementById("delete_confirm");
                deleteNewsButton.addEventListener("click", function() {
                    deleteNews(id);
                });
            }
        }

    </script>

    <script>
        function delCommentEvent(id, reputation, replies){
            const article = document.querySelector("#comment_"+id)
            if(reputation != 0){
                alert('Comments with reputation cannot be deleted.')
                return
            }
            if(replies != 0){
                alert('Comments with replies cannot be deleted.')
                return
            }
            document.getElementById("delete_comment_"+id).submit();
        }

        function editCommentEvent(id){
            const article = document.querySelector("#comment_"+id)
            const canc = article.querySelector("#edit_comment")
            if(canc.innerText == "Edit"){
                canc.innerText="Cancel Edit"
            }else if(canc.innerText == "Cancel Edit"){
                canc.innerText="Edit"
            }
            const form = article.querySelector('#edit_comment_form')
            const comment = article.querySelector('#comment_disapear')
        }

        async function delReplyEvent(news_id, reply_id, user_id, isAdmin){
            delAjax(reply_id)
            
            var myModalEl = document.getElementById('replyModal-'+reply_id);
            var modal = bootstrap.Modal.getInstance(myModalEl)
            modal.hide();

            toggleReplies(news_id, user_id, isAdmin)
            toggleReplies(news_id, user_id, isAdmin)
        }

        async function editAjax(id){
            const content = document.querySelector('#comment_'+id+' #edit_text').value
            const response = await fetch("/api/editReply", {
                method: 'post',
                headers:{
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    //'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-Token': document.querySelector('input[name=_token]').value
                },
                body: JSON.stringify({
                    'csrf-token': document.querySelector('input[name=_token]').value,
                    'id': id,
                    'content': content
                })
            })
        }

        async function delAjax(id){
            const response = await fetch("/api/delReply", {
                method: 'delete',
                headers:{
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector('input[name=_token]').value
                },
                body: JSON.stringify({
                    'csrf-token': document.querySelector('input[name=_token]').value,
                    'id': id,
                })
            })
            const replies = await response.JSON
            console.log(replies)
        }

        async function toggleReplies(id, user_id, isAdmin){
            const repliesDiv = document.querySelector("#repliesDiv-"+id)
            const flag = document.getElementById("reply_flag_" + id)

            const show = document.getElementById("showReplies")
            const hide = document.getElementById("hideReplies")

            if(flag.value === "0"){
                flag.value = "1"
                show.style.display = "none";
                hide.style.display = "block";

                //ajax
                const response = await fetch("/api/getReplies", {
                    method: 'post',
                    headers:{
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('input[name=_token]').value
                    },
                    body: JSON.stringify({
                        'csrf-token': document.querySelector('input[name=_token]').value,
                        'id': id
                    })
                })
                const replies = await response.json()

                //build html
                const replySection = document.createElement('div')
                replySection.id="reply-section-"+id

                for(const reply of replies){
                    var replyContent = `
                    <article id="reply_`+reply.id+`" class="news col-xl-10 my-4 p-3 border bg-light" data-id="`+reply.id+`">

                        <section id="reply" class="comment" >
                            <section id="author_tools" class="d-flex flex-row justify-content-between">
                                <h4 class="col-xl-11">`+reply.author+`</h4>

                                @if(Auth::check() && (`+reply.user_id+` == Auth::user()->id) || Auth::user()->isAdmin())
                                    <button id="delete_button" class="btn edit-button" data-bs-toggle="modal" data-bs-target="#replyModal-`+reply.id+`"><i class="bi bi-trash"></i></button>
                                    <button id="toggle_edit" class="btn edit-button" onclick="displayEditForm()"><i class="bi bi-pencil"></i></button>
                                @endif
                            </section>

                            <h4 class="my-auto">`+reply.content+`</h4>
                        </section>

                        @if(Auth::check() && ((`+reply.user_id+` == Auth::user()->id) || Auth::user()->isAdmin()))
                        <form id="edit_comment_form" style="display: none" method="POST" action="{{route('edit_comment')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value=`+reply.id+`>
                            <input type="text" name="content" placeholder="`+reply.content+`" class="w-75 py-2 mt-2">
                            <button id="submit_comment_edit" class="btn btn-outline-dark btn-submit mx-5 rounded-2" type="button">Confirm Changes</button>
                        </form>
                        @endif

                        <div id="comment_footer" class = "d-flex flex-row">
                            <div id="vote" class="d-flex flex-row me-3">
                                <i class="bi bi-caret-up me-2 my-auto"></i>
                                <span id="reputation" class="w-auto m-auto">
                                    `+reply.reputation+` reputation
                                </span>
                                <i class="bi bi-caret-down ms-2 my-auto"></i>
                            </div>
                        </div>
                    </article>`

                    const newReplyModal =`
                    <!-- Modal -->
                    <div class="modal fade" id="replyModal-`+reply.id+`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <form id="delete_reply_`+reply.id+`" method="POST" action="{{route('del_comment')}}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="`+reply.id+`">
                                        <button type="button" class="btn btn-primary fw-bold" onclick="delReplyEvent(`+ reply.id_comment +`, `+ reply.id +`, `+user_id+`, `+isAdmin+`)""> Confirm Delete </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    `

                    replyModals = document.getElementById('replyModals')
                    replyModals.innerHTML = replyModals.innerHTML + newReplyModal

                    replySection.innerHTML = replySection.innerHTML + replyContent
                }
                repliesDiv.appendChild(replySection)

            }
            else if(flag.value === "1"){
                flag.value = "0"
                show.style.display = "block";
                hide.style.display = "none";

                const replySection = repliesDiv.querySelector('#reply-section-'+id)
                replySection.parentNode.removeChild(replySection)
            }
        }

        function toggleReply(id){
            const button = document.querySelector("#reply_toggle_"+id +" .bi")
            const form = document.querySelector('#reply_form_'+id)
            if(button.classList.contains('bi-arrow-90deg-right')){
                button.classList.add('bi-x-lg');
                button.classList.remove('bi-arrow-90deg-right');
                form.style.display="block"
            }
            else{
                button.classList.add('bi-arrow-90deg-right');
                button.classList.remove('bi-x-lg');
                form.style.display="none"
            }
        }

        async function sendReply(id, user_id, isAdmin){
            //get data from form
            const content = document.querySelector('#comment_'+id +' #reply_field').value
            const news_id = window.location.pathname.split("/").pop()
            if(content !== ""){
                toggleReply(id)

                //create ajax request

                const response = await fetch("/api/createReply", {
                    method: 'post',
                    headers:{
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        //'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-Token': document.querySelector('input[name=_token]').value
                    },
                    body: JSON.stringify({
                        'csrf-token': document.querySelector('input[name=_token]').value,
                        'id_comment': id,
                        'content': content,
                        'id_author': user_id,
                        'id_news': news_id
                    })
                })
                const reply = await response.JSON

                const flag = document.querySelector("#reply_flag_" + id)
                if(flag.value==="0"){
                    toggleReplies(id, user_id, isAdmin)
                }
                else{
                    toggleReplies(id, user_id, isAdmin)
                    toggleReplies(id, user_id, isAdmin)
                }
                document.querySelector('#comment_'+id +' #reply_field').value = ""
            }

        }
    </script>
@endsection
