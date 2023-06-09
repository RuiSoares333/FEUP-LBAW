<div class="bubbles">
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>

    <form class="form-auth static-form d-flex flex-column position-absolute text-center text-light col-11 col-sm-8 col-md-6 col-lg-5 col-xl-3" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <h1 class="h1 mb-5 fw-bold text-uppercase">register</h1>

            <input id="name" class="mb-4 text-light" type="text" name="username" value="{{ old('username') }}" required autofocus placeholder="name">
            @if ($errors->has('name'))
            <span class="error">
                {{ $errors->first('name') }}
            </span>
            @endif

            <input id="email" class="mb-4 text-light" type="email" name="email" value="{{ old('email') }}" required placeholder="email@example.com">
            @if ($errors->has('email'))
            <span class="error">
                {{ $errors->first('email') }}
            </span>
            @endif

            <input id="password" class="mb-4 text-light" type="password" name="password" required placeholder="password">
            @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
            @endif

            <input id="password-confirm" class="mb-4 text-light" type="password" name="password_confirmation" required placeholder="confirm password">

            <button class="w-100 h-75 my-1 btn btn-lg btn-primary fw-bolder text-uppercase" type="submit">Register</button>
            <a class="w-100 my-1 btn button-outline-primary fw-bolder text-light text-uppercase" href="{{ route('login') }}">already have an account?</a>
            <a class="w-100 my-1 mx-auto btn button-outline-primary fw-bolder text-uppercase text-light" href="{{ url('/recover') }}">have you forgotten your credentials?</a>
            <p class="mt-5 mb-3 text-light">© SLCN2023</p>
        </form>

</div>