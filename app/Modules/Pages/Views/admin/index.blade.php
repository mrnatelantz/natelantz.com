@extends('pages::admin.layouts.app')

@section('body')
    @if( isset($pages) && count($pages) > 0)
        @foreach($pages as $page)
            <div class="col-md-4">
                {{ $page->name }}
            </div>
        @endforeach
    @else
        <p>No Pages Found</p>
    @endif
@endsection