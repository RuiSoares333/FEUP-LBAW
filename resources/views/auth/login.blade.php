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

    <form class="form-auth static-form d-flex flex-column position-absolute text-center text-light" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <h1 class="h1 mb-5 fw-bold text-uppercase">login</h1>

        <input id="email" class="mb-4 text-light" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="email@example.com">
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

        <div class="checkbox mb-3">
        <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
        </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary fw-bolder text-uppercase" type="submit">login</button>
        <a class="w-100 btn button-outline-primary fw-bolder  text-uppercase text-light" href="{{ route('register') }}">don't have an account?</a>
        <p class="mt-5 mb-3 ">© SLCN2022</p>
    </form>

</div>
