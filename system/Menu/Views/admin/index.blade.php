@extends('menu::admin.layouts.app')

@section('body')
    @if(isset($menus))
        @foreach($menus as $menu)
            <div class="mdl-cell mdl-cell--4-col">
                <div class="mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">{{ $menu->name }}</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Some other info about the menu
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="{{ route('menu.edit', ['id' => $menu->id]) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            Edit Menu
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="mdl-cell mdl-cell--4-col">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-card--expand">
                    <h2 class="mdl-card__title-text">
                        &nbsp; :(
                    </h2>
                </div>
                <div class="mdl-card__supporting-text">
                    No Menus Found
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a href="{{ route('menu.create') }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        Create Menu
                    </a>
                </div>
            </div>
        </div>
        <h4>No Menus Found</h4>
    @endif
@endsection