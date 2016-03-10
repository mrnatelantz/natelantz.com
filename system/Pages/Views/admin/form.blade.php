@extends('pages::admin.layouts.app')

@push('css')
    <link rel="stylesheet" href="/assets/vendor/trumbowyg/ui/trumbowyg.min.css">
    <meta name="page_id" content="{{ $page_id or 0 }}">
@endpush

@section('body')
    <div class="md-cell mdl-cell--10-col">
        <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
            <div class="mdl-tabs__tab-bar">
                <a href="#head-content-types-panel" class="mdl-tabs__tab">Head</a>
                <a href="#body-content-types-panel" class="mdl-tabs__tab is-active">Body</a>
                <a href="#foot-content-types-panel" class="mdl-tabs__tab">Foot</a>
            </div>

            <div class="mdl-tabs__panel" id="head-content-types-panel">
                @include('pages::admin.partials.head-content-types')
            </div>
            <div class="mdl-tabs__panel is-active" id="body-content-types-panel">
                @include('pages::admin.partials.body-content-types')
            </div>
            <div class="mdl-tabs__panel" id="foot-content-types-panel">
                @include('pages::admin.partials.foot-content-types')
            </div>
        </div>
    </div>

    @include('pages::admin.partials.form-sidebar')

    <form action="" method="POST" id="submitForm" style="visibility: hidden;">
        {{ csrf_field() }}
    </form>


@endsection

@push('scripts')
    <script src="/assets/vendor/trumbowyg/trumbowyg.min.js"></script>
    <script src="{{ elixir('assets/js/pages/pages-form.js') }}"></script>
@endpush
