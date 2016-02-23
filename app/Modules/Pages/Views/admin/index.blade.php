@extends('pages::admin.layouts.app')

@section('body')
    @if( isset($pages) && count($pages) > 0)
        @foreach($pages as $page)
            <div class="col-md-4">
                <a href="{{ route('pages.show', ['id' => $page->id]) }}">{{ $page->name or null }}</a>
            </div>
        @endforeach
    @else
        <p>No Pages Found</p>
    @endif
@endsection