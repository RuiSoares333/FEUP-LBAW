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

<script>
    const followTag = document.getElementsByClassName('h3');
    for (i = 0; i < followTag.length; i++) {
        const item = parseInt(followTag[i].innerHTML);
        if(item>=1000000000){
            followTag[i].innerHTML = (item/1000000000).toFixed(item % 1000000000 != 0)+'B';
        }
        else if(item>=1000000){
            followTag[i].innerHTML = (item/1000000).toFixed(item % 1000000 != 0)+'M';
        }
        else if(item>=1000){
            followTag[i].innerHTML = (item/1000).toFixed(item % 1000 != 0)+'k';
        }
    }

</script>
@endsection
