@extends('layouts.app')
@section('page-title', 'Recover Password')

@section('content')

    @include('partials.header')
    @include('auth.recover_password')
    
@endsection

@section('scripts')

<script>
    document.body.style.background = "linear-gradient(0deg, #bf6324 0%, #b92a4c 100%)";
    document.body.style.overflowY ="hidden";
    document.body.style.padding = "0";
</script>

@endsection
