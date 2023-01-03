@extends('layouts.app')
@section('page-title', 'Tag')
@section('content')

    @include('partials.header')
    @include('partials.tag', [$tag, $news, $user])

@endsection

@section('scripts')

<script>
    document.body.style.background = "linear-gradient(0deg, #bf6324 0%, #b92a4c 100%)";
</script>

@endsection
