@extends('layouts.app')
@section('title', 'Profile')
@section('content')

    @include('partials.header')
    @include('partials.profile', [$user, $foto])

@endsection

