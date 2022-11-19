@extends('layouts.app')

@section('title', $news->name)

@section('news')
  @include('partials.newspost', ['news' => $news])
@endsection
