@extends('layouts.app')

@section('content')
    <h1>{{ $page->name }}</h1>
    <img src="{{ $page->cover_image }}">

    @if(isset($page))
        {{ $page }}
    @endif
@endsection