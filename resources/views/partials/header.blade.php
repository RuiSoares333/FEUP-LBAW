<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top text-uppercase">
    <div class="container">
        <div class="d-flex flex-row">
            <a class="navbar-brand" href="{{ url('/') }}">slcn</a>

            <form role="search" class="input-group" action="{{ route('search') }}">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort By:
                    </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                @if(request('filter') == "top")
                                <input type="radio" name="filter" id="top" value="top" checked/>
                                @else
                                <input type="radio" name="filter" id="top" value="top"/>
                                @endif
                                <label for="top">Highest Reputation</label>
                            </li>
                            <li>
                                @if(request('filter') == "recent")
                                <input type="radio" name="filter" id="recent" value="recent" checked/>
                                @elseif(!request('filter'))
                                <input type="radio" name="filter" id="recent" value="recent" checked/>
                                @else
                                <input type="radio" name="filter" id="recent" value="recent"/>
                                @endif
                                <label for="recent">Most Recent</label>
                            </li>
                        </ul>
                        <button type="submit" class="input-group-text"><i class="bi bi-search"></i></button>
                        <input id="search-input" class="form-control" type="search" placeholder="what are you looking for?" name="search" value="{{ request('search') }}">
                </div>
            </form>
        </div>

        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navbarResponsive" class="collapse navbar-collapse" >
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @if (Auth::check())
                <li class="nav-item my-auto"><a class="nav-link" href="{{ url('/logout') }}">logout</a></li>
                <li class="nav-item my-auto"><a href="/profile/{{Auth::user()->id}}">{{Auth::user()->username }}</a></li>
                @else
                <li class="nav-item my-auto"><a class="nav-link" href="{{ url('/register') }}">register</a></li>
                <li class="nav-item my-auto"><a class="nav-link" href="{{ url('/login') }}">login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
