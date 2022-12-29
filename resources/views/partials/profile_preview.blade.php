@if($user_preview -> id !== 5)
<article id="user-prev" class="news mx-auto my-5 mx-auto col-xl-10 py-3 px-5 d-flex flex-row border bg-light rounded-2" data-id="{{ $user_preview->id }}">
    <img src="{{asset('pictures/user/' . $user_preview->picture ) }}" class="rounded-circle col-3 col-lg-2">
    <div class="d-flex flex-column mx-3 my-auto">
        <a class="mini-username mb-2 h4" href="/profile/{{$user_preview->id}}">{{ $user_preview->username }}</a>
        <span class="mt-2">{{ $user_preview->reputation() }} reputation</span> 
    </div>
    <button class="ms-auto my-auto h-25 btn btn-outline-dark">Follow</button>
</article>
@endif