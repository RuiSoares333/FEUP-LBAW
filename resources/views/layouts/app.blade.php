<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/milligram.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/input.css') }}" rel="stylesheet">
    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
    <script type="text/javascript" src={{ asset('js/app.js') }} defer>
    </script>
  </head>
  <body id="page-top">
      <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container px-5">
          <div class="collapse navbar-collapse">
            <input type="text" placeholder="search">
          </div>
          <h1><a href="{{ url('/news') }}">slcn</a></h1>
          <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="navbar-collapse collapse" id="navbarResponsive" style="">
              @if (Auth::check())
              <a class="nav-link" href="{{ url('/logout') }}">logout</a>
              <span>{{ Auth::user()->name }}</span>
              @else
              <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">register</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">login</a></li>
              </ul>
              @endif
          </div>
        </div>
      </nav>
      <header class="masthead text-center text-white">
          <div class="masthead-content">
              <div class="container px-5">
                  <h1 class="masthead-heading mb-0">super legit collaborative news</h1>
                  <h2 class="masthead-subheading mb-0">super credible news</h2>
                  <a class="btn btn-primary btn-xl rounded-pill mt-5" href="{{ url('/aboutus') }}">about us</a>
              </div>
          </div>
          <div class="bg-circle-1 bg-circle"></div>
          <div class="bg-circle-2 bg-circle"></div>
          <div class="bg-circle-3 bg-circle"></div>
          <div class="bg-circle-4 bg-circle"></div>
      </header>
    <main>
      <section id="content">
        @yield('content')
      </section>
    </main>
  </body>
</html>
