@extends('layouts.app')
@section('title', 'Profile')
@section('content')

    @include('partials.header')
    @include('partials.profile', $user)

@endsection

@section('scripts')

<script>
    document.body.style.background = "linear-gradient(0deg, #bf6324 0%, #b92a4c 100%)";
</script>

<script>
    const followProfile = document.getElementsByClassName('h3');
    for (i = 0; i < followProfile.length; i++) {
        const item = parseInt(followProfile[i].innerHTML);
        if(item>=1000000000){
            followProfile[i].innerHTML = (item/1000000000).toFixed(item % 1000000000 != 0)+'B';
        }
        else if(item>=1000000){
            followProfile[i].innerHTML = (item/1000000).toFixed(item % 1000000 != 0)+'M';
        }
        else if(item>=1000){
            followProfile[i].innerHTML = (item/1000).toFixed(item % 1000 != 0)+'k';
        }
    } 

</script>
@endsection