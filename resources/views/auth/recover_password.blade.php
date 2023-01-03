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

    <form class="form-auth static-form d-flex flex-column position-absolute text-center text-light col-11 col-sm-9 col-md-7 col-lg-5 col-xl-4" method="GET" action="{{ url('/recover_password') }}">
        {{ csrf_field() }}
        <h1 class="h1 mb-5 fw-bold text-uppercase">Password Recovery</h1>

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

        <input id="password-confirm" class="mb-4 text-light" type="password" name="password_confirmation" required placeholder="confirm password">

        <button class="w-100 btn btn-lg btn-primary fw-bolder text-uppercase my-1" type="submit">submit</button>
        <p class="mt-5 mb-3 ">© SLCN2023</p>
    </form>

</div>
