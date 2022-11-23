@extends('layouts.app')
@section('title', 'Edit Profile')
@section('content')

@include('partials.header')

@if(auth::check())
<div id="form-newspost" class="my-5 row justify-content-center">
    <form class="mt-2 edit_profile_username" method="POST" action="{{ route('edit_profile_api', ['id'=>$user->id]) }}" enctype="multipart/form-data">
        <h1>Edit Profile</h1>
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$user->id}}">
        <input class="h2 fw-bold text-center " name="username" type="text" value="{{$user->username}}">  </h2>
        <input class="h2 fw-bold text-center " name="country" type="text" value="{{$user->country}}"></h2>
        <input class="h2 fw-bold text-center " name="email" type="text" placeholder="email"></h2>
        <input class="h2 fw-bold text-center " name="password" type="password" placeholder="password"></h2>
        <input type="file" name="picture" accept="image/png, image/jpeg" />
        <input type="submit" value="Submit">
    </form>
@endif


