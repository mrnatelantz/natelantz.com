@extends('menu::admin.layouts.app')

@section('body')
    <div class="mdl-grid">
        <form action="{{ route('menu.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="mdl-cell mdl-cell--4-col">
                <div class="mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">New Menu</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="name" name="name" require aria-required="true">
                            <label class="mdl-textfield__label" for="name">Menu Name</label>
                        </div>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
