<article class="news col-xl-10 mx-auto my-4 p-3 d-flex flex-row border bg-light" data-id="{{ $newspost->id }}">

    <nav id="vote" class="d-flex flex-column">
        <i class="mx-auto bi bi-caret-up"></i>
        <span id="reputation" class="reputation my-1 mx-auto">
            {{ $newspost->reputation }}
        </span>
        <i class="mx-auto bi bi-caret-down"></i>
    </nav>

    <div id="news_body" class="ps-4 w-100">
        <header>
            <div class="d-flex flex-row justify-content-between">
                <h4 class="col-xl-11"><a class="text-decoration-none text-dark" href="/news/{{ $newspost->id }}">{{ $newspost->title }}</a></h4>
                    @if(Auth::check() && (($newspost->author()->get()->first()->id == Auth::user()->id) || Auth::user()->isAdmin()))
                        @if(request()->is('news/*'))
                            <button id="delete_button" class="btn edit-button" data-bs-toggle="modal" data-bs-target="#newsModal-{{ $newspost->id }}" onclick="deleteButtonEvent( {{$newspost->id}} )"><i class="bi bi-trash"></i></button>
                        @endif
                        <button id="toggle_edit" class="btn edit-button" onclick="displayEditForm()"><i class="bi bi-pencil"></i></button>
                        {{-- isto é para tirar daqui --}}
                        {{-- <form id="edit_form" method="POST" class="disapear" action="{{ route('update_news', ['news_id'=>$newspost->id]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            Title
                            <input class="new_news_input" type="text" name="title" value= "{{ $newspost->title }}">
                            tags
                            <textarea rows="10" cols="60" class="new_news_input"  type="text" name="content"> {!! $newspost->content !!} </textarea>
                            <input type="file" name="picture" accept="image/png, image/jpeg"/>
                            <input type="hidden" name="news_id" value = {{$newspost->id}}>
                            <button id="edit_button" class="btn-submit mx-3 rounded-2" type="submit">Confirm</button>
                        </form> --}}
                    @endif
            </div>
            <span class="my-auto"><a class="text-decoration-none text-dark" href="/profile/{{$newspost->author()->get()->first()->id}}">{{ $newspost->author()->get()->first()->username}}</a></span>
        </header>
    
        <div id="news_content">{!! $newspost->content !!}</div>
    

        @if(request()->is('news/*'))
            <form id="new_comment" method="POST" class="input-group" action="{{route('new_comment')}}" >
                {{ csrf_field() }}
                <input type="hidden" name="id_news" value = {{$newspost->id}}>

                <div class="input-group mb-3">
                    <input class="form-control" type="text" name="content" placeholder="leave your comment here!" aria-label="Recipient's username" aria-describedby="submit_comment">
                    <button id="submit_comment" class="btn btn-outline-dark btn-submit" type="submit">Comment</button>
                </div>
            </form>
        @endif
    </div>

</article>

@if(request()->is('news/*'))
<!-- Modal -->
<div class="modal fade" id="newsModal-{{ $newspost->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p>Are you sure you want to <b>permanently</b> delete your post?</p> 
                <p>This action is <b>irreversible</b>.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary fw-bold text-light" data-bs-dismiss="modal">Close</button>
                <form id="delete_form" method="POST">
                    {{ csrf_field() }}
                    <button type="button" id="delete_confirm" class="btn btn-primary fw-bold" > Confirm Delete </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
