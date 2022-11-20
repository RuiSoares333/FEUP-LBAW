@extends('layouts.app')
@section('page-title', 'Login')
@section('content')

    @include('partials.header')
    @include('auth.login')
    
@endsection

