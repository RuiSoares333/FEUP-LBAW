<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') | SLCN</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>

  </head>
  <body id="page-top">
    @yield('content')
    @yield('scripts')
  </body>

  <script>
    const reputations = document.getElementsByClassName('reputation');
    for (i = 0; i < reputations.length; i++) {
        const item = parseInt(reputations[i].innerHTML);
        if(item>=1000000000){
          reputations[i].innerHTML = (item/1000000000).toFixed(item % 1000000000 != 0)+'B';
        }
        else if(item>=1000000){
          reputations[i].innerHTML = (item/1000000).toFixed(item % 1000000 != 0)+'M';
        }
        else if(item>=1000){
          reputations[i].innerHTML = (item/1000).toFixed(item % 1000 != 0)+'k';
        }
    }
  </script>

</html>
