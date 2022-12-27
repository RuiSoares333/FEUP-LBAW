@extends('layouts.app')
@section('title', 'Edit Profile')

@section('content')

    @include('partials.header')

    @if(auth::check())
    <div id="form-newspost" class="bubbles">
        <form class="edit_profile_username static-form d-flex flex-column position-absolute text-center text-light" method="POST" action="{{ route('edit_profile_api', ['id' => $user->id]) }}" enctype="multipart/form-data">
            <h1 class="my-3">Edit Profile</h1>
            {{ csrf_field() }}
            <input type="hidden" name="id" id="edit_id" value="{{$user->id}}">
            <input class="fw-bold text-center" name="username" type="text" value="{{$user->username}}">  </h2>
            <input class="fw-bold text-center" name="country" type="text" value="{{$user->country}}"></h2>
            <input class="fw-bold text-center" name="email" type="text" value="{{$user->email}}"></h2>
            <input class="fw-bold text-center" name="password" type="password" placeholder="password"></h2>
            <input class="form-control w-75 mx-auto" type="file" name="picture" id="formFile" accept="image/png, image/jpeg">
            <button class="btn btn-primary fw-bold w-50 mx-auto" type="submit" id="edit_profile"> Submit </button>
        </form>
    @endif

@endsection

@section('scripts')

<script>
    document.body.style.background = "linear-gradient(0deg, #bf6324 0%, #b92a4c 100%)";
</script>

@endsection
