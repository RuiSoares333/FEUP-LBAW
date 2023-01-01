<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top text-uppercase">
    <div class="container d-flex flex-row mx-auto col-xl-10 col-md-11 col-12">
        <div class="d-flex flex-row col-10 justify-content-around">
            <a class="navbar-brand-name fw-bold h2" href="{{ url('/') }}">slcn</a>

            <form role="search" class="input-group w-75" action="{{ route('search') }}">
                <button type="submit" class="input-group-text"><i class="bi bi-search"></i></button>
                <input id="search-input" class="form-control" type="search" placeholder="what are you looking for?" name="search" value="{{ request('search') }}">
            </form>
        </div>

        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navbarResponsive" class="collapse navbar-collapse col-2" >
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @if (Auth::check())
                <li class="nav-item my-auto"><a class="nav-link" href="{{ url('/logout') }}">logout</a></li>
                <li class="nav-item my-auto"><a href="/profile/{{Auth::user()->id}}">{{Auth::user()->username }}</a></li>
                <li class="d-inline d-lg-none nav-item my-auto"><a href="{{url('about_us')}}">About Us</a></li>

                @else
                <li class="nav-item my-auto"><a class="nav-link" href="{{ url('/register') }}">register</a></li>
                <li class="nav-item my-auto"><a class="nav-link" href="{{ url('/login') }}">login</a></li>
                <li class="d-inline d-lg-none nav-item my-auto"><a href="{{url('about_us')}}">About Us</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
