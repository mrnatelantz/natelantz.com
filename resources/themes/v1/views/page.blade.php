@extends('layouts.app')

@push('css')
    <style>
        .main-header{
            background-color: #16a085;
            padding-top: 2%;
            padding-bottom: 2%;
        }
    </style>
@endpush
@section('content')
    @if(isset($page))
        <div class="main-header">
            <h1 class="text-center">{{ $page->name }}</h1>
        </div>
        @if(isset($page->content))
            @foreach($page->content as $contentTypes)
                @foreach($contentTypes as $type => $content)
                    @if(View::exists('content-types.'.$type))
                        @include('content-types.'.$type)
                    @endif
                @endforeach
            @endforeach
        @endif
    @endif
@endsection