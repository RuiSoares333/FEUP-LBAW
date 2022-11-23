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
        <div id="vote" class="fs-1 d-flex col-2">
            <i class="bi bi-hand-thumbs-up"></i>
            <i class="bi bi-hand-thumbs-down"></i>
            <span id="reputation" class="m-auto">
                {{ $newspost->reputation }} reputation
            </span>
        </div>
        <form id="new_comment" methood="POST" class="col-10 justify-content-end">
            <input class="mx-4" type="text" name="new_comment{{ $newspost->id}}" placeholder="leave your comment here!">
            <button id="submit_comment" class="btn-submit mx-5 rounded-2" type="submit">comment</button>
        </form>
    </footer>

    @if(Auth::check() && $newspost->author()->get()->first()->id == Auth::user()->id)
        <div id="editpost" class="row w-100 d-flex flex-column">
            <h3 class="mx-auto w-auto">Author Tools:</h3>
            <section class="author_tools mx-auto w-auto">
                <form id="delete_form" method="POST" action="{{ route('delete_news', ['news_id'=>$newspost->id]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="news_id" value = {{$newspost->id}}>
                    <button id="delete_button" class="btn-submit mx-3 rounded-2" type="submit">Delete</button>
                </form>
                <form id="edit_form" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="news_id" value = {{$newspost->id}}>
                    <button id="edit_button" class="btn-submit mx-3 rounded-2" type="submit">Edit</button>
                </form>
            </section>
        </div>
    @endif
</article>
