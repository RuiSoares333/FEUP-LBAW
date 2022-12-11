<article class="news container my-5 d-flex flex-column border bg-light" data-id="{{ $newspost->id }}">
    <header class="m-3 d-flex flex-column">
        <h2 class="my-auto"><a href="/news/{{ $newspost->id }}">{{ $newspost->title }}</a></h2>
        <span class="my-auto"><a href="/profile/{{$newspost->author()->get()->first()->id}}">{{ $newspost->author()->get()->first()->username}}</a></span>
    </header>

    <div class="mx-3 d-flex flex-row"><p>{!! $newspost->content !!}</p></div>

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
            <form id="new_comment" methood="POST" class="col-10 justify-content-end">
                <input class="mx-4" type="text" name="new_comment{{ $newspost->id}}" placeholder="leave your comment here!">
                <button id="submit_comment" class="btn btn-outline-dark btn-submit mx-5 rounded-2" type="submit">comment</button>
            </form>
        @endif
    </footer>

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

</article>
