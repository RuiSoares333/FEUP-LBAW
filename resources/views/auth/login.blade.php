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

    <form class="form-auth static-form d-flex flex-column position-absolute text-center text-light col-11 col-sm-8 col-md-6 col-lg-4 col-xl-3" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <h1 class="h1 mb-5 fw-bold text-uppercase">login</h1>

        <input id="email" class="text-light m-0" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="email@example.com">
        @if ($errors->has('email'))
            <span class="error mt-1" style="margin-top: -1em;">
            {{ $errors->first('email') }}
            </span>
        @endif

        <input id="password" class="mt-4 text-light" type="password" name="password" required placeholder="password">
        @if ($errors->has('password'))
            <span class="error mt-1" style="margin-top: -1em;">
                {{ $errors->first('password') }}
            </span>
        @endif

        <div class="checkbox mt-3 d-flex flex-row mx-auto">
            <input type="checkbox" class="my-0 me-1" name="remember" {{ old('remember') ? 'checked' : '' }}> <label clasS="my-auto">Remember me</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary fw-bolder text-uppercase my-1" type="submit">login</button>
        <a class="w-100 my-1 mx-auto btn button-outline-primary fw-bolder text-uppercase text-light" href="{{ route('register') }}">don't have an account?</a>
        <a class="w-100 my-1 mx-auto btn button-outline-primary fw-bolder text-uppercase text-light" href="{{ url('/recover') }}">have you forgotten your credentials?</a>
        <p class="mt-5 mb-3 ">© SLCN2023</p>
    </form>

</div>
