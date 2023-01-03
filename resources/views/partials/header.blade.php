<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('730b9185b760246c7a3a', {
    cluster: 'eu'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
    const id = document.querySelector('#user_id').value
    myJson = JSON.parse(data.message)
    // if(myJson.user_id == id) return
    if(myJson.receiver_id == id){

        const notCont = document.getElementById("toast-container");

        if(myJson.type == 'news'){
            var replyContent = `
            <div id="tosta_`+myJson.user_id+`" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="opacity: 1;">                
                <div class="toast-header">
                    <strong class="me-auto">Notification</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="closeToast(`+myJson.user_id+`)"></button>
                </div>
                <div class="toast-body">
                    Your <a href="/news/`+ myJson.id + `">post</a> has just been voted by <a href="/profile/`+ myJson.user_id + `">`+myJson.user_name+`</a>
                </div>
            </div>`
        }
        else{
            var replyContent = `
            <div id="tosta_`+myJson.user_id+`" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="opacity: 1;">                
                <div class="toast-header">
                    <strong class="me-auto">Notification</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="closeToast(`+myJson.user_id+`)"></button>
                </div>
                <div class="toast-body">
                    Your <a href="`+ myJson.id + `">comment</a> has just been voted by <a href="/user/`+ myJson.user_id + `">`+myJson.user_name+`</a>
                </div>
            </div>`
        }


        notCont.innerHTML = notCont.innerHTML + replyContent;

        console.log(myJson)
    }
});
</script>

<script>
    function closeToast(id){
        const elem = document.getElementById("tosta_"+id);
        elem.parentNode.removeChild(elem);
    }
</script>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top text-uppercase">
    @if(Auth::check())
        <input id="user_id" type="hidden" value="{{Auth::user()->id}}">
    @endif
    <div class="container d-flex flex-row mx-auto col-xl-10 col-md-11 col-12">
        <div class="d-flex flex-row col-10 justify-content-around">
            <a class="navbar-brand-name fw-bold h2" href="{{ url('/') }}">slcn</a>

            <div class="col-7">
                <form role="search" class="input-group" action="{{ route('search') }}">
                    <button type="submit" class="input-group-text"><i class="bi bi-search"></i></button>
                    <input id="search-input" class="form-control" type="search" placeholder="what are you looking for?" name="search" value="{{ request('search') }}">

                    <button class="input-group-text" style="border-top-right-radius: .25rem; border-bottom-right-radius: .25rem;" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                        <i class="bi bi-filter"></i>
                    </button>
                    <ul class="dropdown-menu w-100 px-5 py-3" aria-labelledby="dropdownMenuButton1">
                        <li>
                            @if(request('filter') == "top")
                            <input class="form-check-input" type="radio" name="filter" id="top" value="top" checked/>
                            @else
                            <input class="form-check-input" type="radio" name="filter" id="top" value="top"/>
                            @endif
                            <label for="top">Highest Reputation</label>
                        </li>
                        <li>
                            @if(request('filter') == "recent")
                            <input class="form-check-input" type="radio" name="filter" id="recent" value="recent" checked/>
                            @elseif(!request('filter'))
                            <input class="form-check-input" type="radio" name="filter" id="recent" value="recent" checked/>
                            @else
                            <input class="form-check-input" type="radio" name="filter" id="recent" value="recent"/>
                            @endif
                            <label for="recent">Most Recent</label>
                        </li>
                    </ul>
                </form>
            </div>

        </div>

        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navbarResponsive" class="collapse navbar-collapse col-2" >
            <ul class="navbar-nav mb-2 mb-lg-0">
                @if (Auth::check())
                    <li class="nav-item my-auto"><a class="nav-link" href="{{ url('/logout') }}">logout</a></li>
                    <li class="nav-item my-auto">
                        <a href="/profile/{{Auth::user()->id}}" id="profile-picture">
                            @if(Auth()->user()->picture !== 'default.png')
                                <img src="{{asset('pictures/user/' . Auth()->user()->id . '/' . Auth::user()->picture ) }}" class="rounded-circle col-6 col-lg-3 img-fluid ">
                            @else
                                <img src="{{asset('pictures/user/default.png')}}" class="rounded-circle col-6 col-lg-3 img-fluid ">
                            @endif
                        </a>
                    </li>
                    <li class="d-inline d-lg-none nav-item my-auto"><a href="{{url('rte')}}">Share Your Story</a></li>
                    <li class="d-inline d-lg-none nav-item my-auto"><a href="{{url('about_us')}}">About Us</a></li>
                @else
                    <li class="nav-item my-auto"><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                    <li class="nav-item my-auto"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                    <li class="d-inline d-lg-none nav-item my-auto"><a href="{{url('about_us')}}">About Us</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0" style="z-index: 9999;">
    <div id="toast-container" class="toast-container p-3">

    </div>
</div>
