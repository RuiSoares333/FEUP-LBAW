@extends('layouts.app')
@section('title', 'Edit Profile')
@section('content')

@include('partials.header')

@if(auth::check())
<div id="form-newspost" class="my-5 row justify-content-center">
    <div class="mt-2 edit_profile_username">
        <h1>Edit Profile</h1>
        <input class="h2 fw-bold text-center " type="text" value={{$user->username}}></h2>
        <input class="h2 fw-bold text-center " type="text" value={{$user->country}}></h2>
        <input class="h2 fw-bold text-center " type="text" value={{$user->email}}></h2>
        <input class="h2 fw-bold text-center " type="password" value={{$user->password}}></h2>
        <input type="submit" value="Submit">
    </div>
@endif


