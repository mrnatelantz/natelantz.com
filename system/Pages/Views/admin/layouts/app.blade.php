@extends('radcms::layouts.app')

@push('page_title')
    <a href="{{ route('pages.create.get') }}"  class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored">
        <i class="material-icons">add</i>
    </a>
    Pages
@endpush

@section('content')

    @yield('body')

@endsection