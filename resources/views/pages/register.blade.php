@extends('layouts.app')
@section('page-title', 'Register')

@section('content')

    @include('partials.header')
    @include('auth.register')

@endsection

@section('scripts')

<script>
    document.body.style.background = "linear-gradient(0deg, #bf6324 0%, #b92a4c 100%)";
</script>

@endsection