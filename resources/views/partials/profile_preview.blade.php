@if($user_preview -> id !== 5)
<article id="user-prev" class="news mx-auto my-3 mx-auto col-11 py-2 py-md-6 px-3 px-md-2 px-lg-4 d-flex flex-row border bg-light rounded-2" data-id="{{ $user_preview->id }}">
    <img src="{{asset('pictures/user/' . $user_preview->picture ) }}" class="my-auto h-100 rounded-circle col-2 col-md-3 img-fluid">
    <div class="d-flex flex-column mx-3 my-auto col-4">
        <a class="mini-username mb-2 h4 fw-bold text-truncate text-nowrap col-12 " href="/profile/{{$user_preview->id}}">{{ $user_preview->username }}</a>
        <span class="mt-2 text-nowrap">{{ $user_preview->reputation() }} reputation</span> 
    </div>
    @if(Auth::check() and (Auth::id() != $user_preview->id))
        <form id="follow_form" class="ms-auto my-auto" method="POST">
            {{ csrf_field() }}
            <input type="hidden" class="user-{{Auth::id()}}" name="id1" value={{ Auth::id() }}>
            <input type="hidden" class="user-{{$user_preview->id}}" name="id2" value={{ $user_preview->id }}>
            
            @if(!Auth::user()->check_follow(Auth::id(), $user_preview->id))
                <button class="h-25 btn btn-outline-dark follow_button_{{$user_preview->id}}" type="button" onclick="followAction({{ Auth::id() }}, {{ $user_preview->id }})">Follow</button>
            @else
                <button class="h-25 btn btn-dark follow_button_{{$user_preview->id}}" type="button" onclick="followAction({{ Auth::id() }}, {{ $user_preview->id }})">Unfollow</button>
            @endif
        </form>
    @endif
</article>
@endif
