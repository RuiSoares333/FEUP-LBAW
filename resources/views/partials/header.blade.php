<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top text-uppercase">
    <div class="container d-flex flex-row mx-auto col-xl-10 col-md-11 col-12">
        <div class="d-flex flex-row col-10 justify-content-around">
            <a class="navbar-brand-name fw-bold h2" href="{{ url('/') }}">slcn</a>

            <div class="col-7">
                <form role="search" id = "search_form" class="input-group" action="{{ route('search') }}">
                    <button type="submit" class="input-group-text"><i class="bi bi-search"></i></button>
                    <input id="search-input" class="form-control" type="search" placeholder="what are you looking for?" name="search" value="{{ request('search') }}">
                
                    <button class="input-group-text" style="border-top-right-radius: .25rem; border-bottom-right-radius: .25rem;" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                        <i class="bi bi-filter"></i>
                    </button>
                    <ul class="dropdown-menu w-100 px-5 py-3" aria-labelledby="dropdownMenuButton1">
                        <li>
                            @if(request('filter') == "top_users")
                            <input class="form-check-input d-none" type="radio" name="filter" id="top_users" value="top_users" checked/>
                            @else
                            <input class="form-check-input d-none" type="radio" name="filter" id="top_users" value="top_users"/>
                            @endif
                            <label for="top_users" class="btn btn-outline-danger" id="tu_button">
                                Top Users
                            </label>
                        </li>
                        <li>
                            @if(request('filter') == "top_news")
                            <input class="form-check-input d-none" type="radio" name="filter" id="top_news" value="top_news" checked/>
                            @else
                            <input class="form-check-input d-none" type="radio" name="filter" id="top_news" value="top_news"/>
                            @endif
                            <label for="top_news" class="btn btn-outline-danger" id="tn_button">
                                Top News
                            </label>
                        </li>
                        <li>
                            @if(request('filter') == "recent_news")
                            <input class="form-check-input d-none" type="radio" name="filter" id="recent_news" value="recent_news" checked/>
                            @elseif(!request('filter'))
                            <input class="form-check-input d-none" type="radio" name="filter" id="recent_news" value="recent_news" checked/>
                            @else
                            <input class="form-check-input d-none" type="radio" name="filter" id="recent_news" value="recent_news"/>
                            @endif
                            <label for="recent_news" class="btn btn-outline-danger" id="rn_button">
                                Most Recent News
                            </label>
                        </li>
                        <li>
                            @if(request('filter') == "tags")
                            <input class="form-check-input d-none" type="radio" name="filter" id="tags" value="tags" checked/>
                            @else
                            <input class="form-check-input d-none" type="radio" name="filter" id="tags" value="tags"/>
                            @endif
                            <label for="tags" class="btn btn-outline-danger" id="t_button">
                                Tags
                            </label>
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
                    <li class="nav-item my-auto" id="profile-picture-item">
                        <a href="/profile/{{Auth::user()->id}}" id="profile-picture">
                            @if(Auth()->user()->picture !== 'default.png')
                                <img src="{{asset('pictures/user/' . Auth()->user()->id . '/' . Auth::user()->picture ) }}" class="rounded-circle col-2 col-lg-4 img-fluid ">
                            @else
                                <img src="{{asset('pictures/user/default.png')}}" class="rounded-circle col-2 col-lg-4 img-fluid ">
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

<script>
    const search_form = document.getElementById("search_form");
    const tu_button = document.getElementById("tu_button");
    const tn_button = document.getElementById("tn_button");
    const rn_button = document.getElementById("rn_button");
    const t_button = document.getElementById("t_button");
    const top_users = document.getElementById("top_users");
    const top_news = document.getElementById("top_news");
    const recent_news = document.getElementById("recent_news");
    const tags = document.getElementById("tags");
    if (top_users.checked) {
        tu_button.classList.toggle('active');
    }
    if (top_news.checked) {
        tn_button.classList.toggle('active');
    }
    if (recent_news.checked) {
        rn_button.classList.toggle('active');
    }
    if (tags.checked) {
        t_button.classList.toggle('active');
    }
    tu_button.addEventListener("click", submitTopUsers);
    tn_button.addEventListener("click", submitTopNews);
    rn_button.addEventListener("click", submitRecentNews);
    t_button.addEventListener("click", submitTags);
    function submitTopUsers() { 
        top_users.checked = true;
        search_form.submit();
    }
    function submitTopNews() {
        top_news.checked = true;
        search_form.submit();
    }
    function submitRecentNews() {
        recent_news.checked = true;
        search_form.submit();
    }
    function submitTags() {
        tags.checked = true;
        search_form.submit();
    }
</script>
