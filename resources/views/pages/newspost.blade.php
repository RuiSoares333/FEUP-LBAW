@extends('layouts.app')

@section('title', $news->name)

@section('news')
  @include('partials.news', ['news' => $news])
@endsection
