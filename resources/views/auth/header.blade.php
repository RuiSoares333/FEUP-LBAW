@extends('layouts.app')

@section('header', 'Top')

@section('header')
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container px-5">
        <div class="collapse navbar-collapse">
        <input type="text" placeholder="search">
        </div>
        <h1><a href="{{ url('/cards') }}">slcn</a></h1>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarResponsive" style="">
            @if (Auth::check())
            <a class="nav-link" href="{{ url('/logout') }}">logout</a>
            <span>{{ Auth::user()->name }}</span>
            @else
            <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">register</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">login</a></li>
            </ul>
            @endif
        </div>
    </div>
</nav>
@endsection