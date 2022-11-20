<div class="text-center form-center form-div">
    <header class="masthead register text-center text-white text-capitalize">
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
        <form class="form-auth register" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <h1 class="h1 mb-5 fw-bold text-uppercase">register</h1>

            <input id="name" class="mb-4 text-light" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="name">
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

            <button class="w-100 btn btn-lg btn-primary fw-bolder text-uppercase" type="submit">Register</button>
            <a class="w-100 btn button-outline-primary fw-bolder text-light text-uppercase" href="{{ route('login') }}">alredy have an account?</a>
            <p class="mt-5 mb-3 text-light">© SLCN2022</p>
        </form>
    </header>
</div>
