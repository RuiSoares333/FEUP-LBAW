<nav id="side-nav" class="d-none d-lg-inline col-lg-3 col-xl-2">
    <div class="masthead">
        <div class="masthead-content text-center text-capitalize text-light">
            <h4 class="mt-4">super legit collaborative news</h4>
            <h5 class="">Followed Tags</h5>
        </div>
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </div>

    <ul>
        @each('partials.list_tag', Auth::user()->followed_tags(), 'tag')
    </ul>

    <a href="{{ url('rte') }}" class="col-10 btn btn-primary rounded-pill border-0 py-2 px-4 text-light ">Share Your Story</button></a>
    <a href="{{ url('about_us') }}">About Us</a>
</nav>