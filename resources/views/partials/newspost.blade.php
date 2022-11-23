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

    <script>
    function displayEditForm(){
        const form = document.querySelector("#edit_form")
        form.classList.toggle('hide')
        console.log('toggle')
        
    }
    </script>
    <div>
    @if(Auth::check() && (($newspost->author()->get()->first()->id == Auth::user()->id) || Auth::user()->isAdmin()) && (request()->is('news/*')))
        <h3>Author Tools:<h3>
        <section class="author_tools">
        <form id="delete_form" method="POST" action="{{ route('delete_news', ['news_id'=>$newspost->id]) }}">
            {{ csrf_field() }}
            <input type="hidden" name="news_id" value = {{$newspost->id}}>
            <button id="delete_button" class="btn-submit mx-3 rounded-2" type="submit">Delete</button>
        </form>
        <button id="toggle_edit" class="btn-submit mx-3 rounded-2 hidden" onclick="displayEditForm()"> Edit</button>
        </section>
        <form id="edit_form" method="POST" class="hide" action="{{ route('update_news', ['news_id'=>$newspost->id]) }}">
            {{ csrf_field() }}
            Title
            <input class="new_news_input" type="text" name="title" value= "{{ $newspost->title }}">
            tags
            <textarea rows="10" cols="60" class="new_news_input"  type="text" name="content"> {{ $newspost->content }} </textarea>
            <a>picture</a>
            <input type="hidden" name="news_id" value = {{$newspost->id}}>
            <button id="edit_button" class="btn-submit mx-3 rounded-2" type="submit">Confirm</button>
        </form>
    @endif
    </div>
</article>
