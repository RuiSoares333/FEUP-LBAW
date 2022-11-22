<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top text-uppercase">
    <div class="container px-5">
        <div class="collapse navbar-collapse">
            <form class="input-group my-3 h2">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input class="form-control text-light" type="search" placeholder="What are you looking for?" name="search" value="{{ request('search') }}">
            </form>
        </div>
        <h1><a href="{{ url('/') }}">slcn</a></h1>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarResponsive" style="">
            @if (Auth::check())
            <a class="nav-link" href="{{ url('/logout') }}">logout</a>
            <a href="/profile/{{Auth::user()->id}}">{{Auth::user()->username }}</a>
            @else
            <ul class="navbar-nav ms-auto">
            <li class="nav-item my-auto"><a class="nav-link" href="{{ url('/register') }}">register</a></li>
            <li class="nav-item my-auto"><a class="nav-link" href="{{ url('/login') }}">login</a></li>
            </ul>
            @endif
        </div>
    </div>
</nav>
