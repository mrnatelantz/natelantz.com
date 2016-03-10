@extends('pages::admin.layouts.app')

@section('body')
    @if( isset($pages) && count($pages) > 0)
        @foreach($pages as $page)
            <div class="mdl-cell mdl-cell--3-col">
                <div class="mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">{{ $page->name or null }}</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Some other info about the page
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="{{ route('pages.show', ['id' => $page->id]) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            Edit Page
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="mdl-cell mdl-cell--3-col">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-card--expand">
                    <h2 class="mdl-card__title-text">
                        &nbsp; :(
                    </h2>
                </div>
                <div class="mdl-card__supporting-text">
                    No Pages Found
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a href="{{ route('pages.create.get') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        Create Page
                    </a>
                </div>
            </div>
        </div>

    @endif
@endsection