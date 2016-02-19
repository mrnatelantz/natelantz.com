@extends('layouts.app')

@section('content')


    @if(isset($page))
        <h1>{{ $page->name }}</h1>
        <img src="{{ $page->cover_image }}">
        @foreach($page->content as $contentTypes)
            @foreach($contentTypes as $type => $content)
                <div class="{{ $type }} well">
                    {!! $content !!}
                </div>
            @endforeach
        @endforeach
    @endif
@endsection