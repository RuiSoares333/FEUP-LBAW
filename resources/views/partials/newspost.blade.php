<article class="news container my-5 d-flex flex-column border bg-light" data-id="{{ $newspost->id }}">
    <header class="m-3 d-flex flex-column">
        <h2 class="my-auto"><a href="/news/{{ $newspost->id }}">{{ $newspost->title }}</a></h2>
        <span class="my-auto"><a href="/profile/{{$newspost->author()->get()->first()->id}}">{{ $newspost->author()->get()->first()->username}}</a></span>
    </header>

    <div class="mx-3 d-flex flex-row"><p>{!! $newspost->content !!}</p></div>

    <script>
        function displayEditForm(){
            const form = document.querySelector("#edit_form")
            form.classList.toggle('disapear')
        }
        function deleteButtonEvent(){
            const delB = document.querySelector("#delete_form")
            const comments = document.querySelector("#comment_section")
            if({{$newspost->reputation}} !== 0){
                alert('A news item with reputation cannot be deleted.')
            }else if(comments.childNodes.length > 1){
                alert("A news item with comments cannot be deleted.")
            }else{
                delB.classList.toggle('disapear')
            }
        }
    </script>

    <div>
    @if(Auth::check() && (($newspost->author()->get()->first()->id == Auth::user()->id) || Auth::user()->isAdmin()) && (request()->is('news/*')))
        <h3>Author Tools:<h3>
        <section class="author_tools">
        <button id="delete_button" class="btn-submit mx-3 rounded-2" onclick="deleteButtonEvent()">Delete</button>
        <form id="delete_form" class="disapear" method="POST" action="{{ route('delete_news', ['news_id'=>$newspost->id]) }}">
            {{ csrf_field() }}
            <input type="hidden" name="news_id" value = {{$newspost->id}}>
            <button id="delete_confirm" class="btn-submit mx-3 rounded-2" type="submit"> Delete Confirm </button>
        </form>
        <button id="toggle_edit" class="btn-submit mx-3 rounded-2 hidden" onclick="displayEditForm()"> Edit</button>
        </section>
        <form id="edit_form" method="POST" class="disapear" action="{{ route('update_news', ['news_id'=>$newspost->id]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            Title
            <input class="new_news_input" type="text" name="title" value= "{{ $newspost->title }}">
            tags
            <textarea rows="10" cols="60" class="new_news_input"  type="text" name="content"> {{ $newspost->content }} </textarea>
            <input type="file" name="picture" accept="image/png, image/jpeg" />
            <input type="hidden" name="news_id" value = {{$newspost->id}}>
            <button id="edit_button" class="btn-submit mx-3 rounded-2" type="submit">Confirm</button>
        </form>
    @endif
    </div>

    <footer class="mx-3 mb-3 d-flex flex-row">
        <div id="vote" class="fs-1 d-flex flex-row col-2">
            <i class="bi bi-caret-up"></i>
            <i class="bi bi-caret-down"></i>

            <span id="reputation" class="m-auto">
                {{ $newspost->reputation }} reputation
            </span>
        </div>
        @if(request()->is('news/*'))
            <form id="new_comment" method="POST" class="col-10 justify-content-end" action="{{route('new_comment')}}" >
                {{ csrf_field() }}
                <input class="mx-4" type="text" name="content" placeholder="leave your comment here!">
                <input type="hidden" name="news_id" value = {{$newspost->id}}>
                <button id="submit_comment" class="btn btn-outline-dark btn-submit mx-5 rounded-2" type="submit">Comment</button>
            </form>
        @endif
    </footer>

</article>

@if(request()->is('news/*'))
    <script>
        function delCommentEvent(id){
            const article = document.querySelector("#comment_"+id)
            const canc = article.querySelector("#delete_comment")
            if(canc.innerText == "Delete"){
                canc.innerText="Cancel Delete"
            }else if(canc.innerText == "Cancel Delete"){
                canc.innerText="Delete"
            }
            const text = article.querySelector("#com_del_text")
            text.classList.toggle('disapear')

            const conf = article.querySelector("#conf_del_com_b")
            conf.classList.toggle('disapear')
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
            form.classList.toggle('disapear')
            const comment = article.querySelector('#comment_disapear')
            comment.classList.toggle('disapear')
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

        async function toggleReplies(id, user_id, isAdmin){
            var section = document.querySelector("#comment_"+id+" #replies")
            const up = section.querySelector("#repliesUp")
            const downDiv = section.querySelector("#repliesDiv")
            up.classList.toggle('disapear')
            downDiv.classList.toggle('disapear')
            const flag = document.getElementById("reply_flag_" + id)


            if(flag.value === "0"){
                flag.value = "1"

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
                const topDiv = document.createElement('div')
                topDiv.id="topDiv"

                for(const reply of replies){
                    const topArticle = document.createElement('article')
                    topArticle.id = "comment_" + reply.id
                    topArticle.classList.add("news", "comment", "container", "my-4", "border", "bg-light")

                    var div = document.createElement('div')
                    div.id = "comment_disapear"

                    const com_sec = document.createElement('section')
                    com_sec.id = "comment"
                    com_sec.classList.add('comment', 'd-flex', 'justify-content-between')

                    var h4 = document.createElement('h4')
                    h4.classList.add('my-auto')
                    h4.innerText = reply.content
                    com_sec.appendChild(h4)

                    h4 = document.createElement('h4')
                    h4.classList.add('my-auto')
                    h4.innerText = reply.author
                    com_sec.appendChild(h4)

                    const vote = document.createElement('div')
                    vote.id = vote
                    vote.classList.add('fs-1', 'd-flex', 'col-2', 'justify-content-end')

                    var i = document.createElement('i')
                    i.classList.add('bi', 'bi-hand-thumbs-up')
                    vote.appendChild(i)

                    i = document.createElement('i')
                    i.classList.add('bi', 'bi-hand-thumbs-down')
                    vote.appendChild(i)

                    const span = document.createElement('i')
                    span.id='reputation'
                    span.classList.add('m-auto')
                    span.innerText = reply.reputation + " reputation"

                    vote.appendChild(span)
                    com_sec.appendChild(vote)
                    div.appendChild(com_sec)
                    topArticle.appendChild(div)

                    //top article
                    //edit field
                    if(user_id == reply.author || isAdmin){
                        var form = document.createElement('div')
                        form.id = 'edit_comment_form'
                        form.classList.add('disapear')

                        const flex = document.createElement('div')
                        flex.classList.add('d-flex')

                        var input = document.createElement('input')
                        input.type = 'text'
                        input.id = 'edit_text'
                        input.name= 'content'
                        input.placeholder = reply.content
                        input.classList.add('w-75', 'py-2', 'mt-2')

                        flex.appendChild(input)

                        var button = document.createElement('button')
                        button.id="submit_comment_edit"
                        button.classList.add('btn', 'btn-outline-dark', 'btn-submit', 'mx-5', 'rounded-2')
                        button.innerText = "Confirm Changes"
                        button.addEventListener("click", function(){
                            editAjax(reply.id)
                            toggleReplies(id, user_id, isAdmin)
                            toggleReplies(id, user_id, isAdmin)
                        })

                        flex.appendChild(button)
                        form.appendChild(flex)

                        topArticle.appendChild(form)
                    }

                    //comment footer
                    div = document.createElement('div')
                    div.id = "comment_footer"
                    div.classList.add('d-flex')

                    if(user_id == reply.author || isAdmin){
                        section = document.createElement('section')
                        section.id = 'edit_comment_sec'
                        section.classList.add('d-flex')


                        const editButtonToggle = document.createElement('button')
                        editButtonToggle.id='edit_comment'
                        editButtonToggle.classList.add('mx-2', 'mt-4', 'mb-1')
                        editButtonToggle.innerText = 'Edit'
                        editButtonToggle.value = reply.id

                        editButtonToggle.addEventListener("click", function(){
                            editCommentEvent(reply.id)
                        })

                        section.appendChild(editButtonToggle)
                        div.appendChild(section)
                    }

                    topArticle.appendChild(div)
                    topDiv.appendChild(topArticle)
                }
                downDiv.appendChild(topDiv)

            }
            else if(flag.value === "1"){
                flag.value = "0"
                const topDiv = downDiv.querySelector('#topDiv')
                topDiv.parentNode.removeChild(topDiv)
            }
        }

        function toggleReply(id){
            const button = document.querySelector('#comment_'+id +' #reply_toggle')
            if(button.innerText==="Reply"){
                button.innerText="Cancel Reply"
            }
            else{
                button.innerText="Reply"
            }
            const form = document.querySelector('#comment_'+id +' #reply_form')
            form.classList.toggle('disapear')
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
                const flag = document.getElementById("reply_flag_" + id)
                if(flag==="0"){
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
@endif
