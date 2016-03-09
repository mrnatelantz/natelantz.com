@extends('menu::admin.layouts.app')

@section('body')
    @if(isset($menu))
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input"
                           type="text"
                           id="name"
                           name="name"
                           value="{{ $menu->name or null }}"
                           require aria-required="true">
                    <label class="mdl-textfield__label" for="name">Menu Name</label>
                </div>
            </div>


            <div class="panel-group col-md-offset-1" id="accordion" role="tablist" aria-multiselectable="true">
                @if(isset($menu->menu_items) && count($menu->menu_items))
                    @foreach($menu->menu_items as $menu_item)
                        @include('menu::admin.partials.menu_item', ['menu_item' => $menu_item, 'menu_id' => $menu->id])
                    @endforeach
                @endif
                @include('menu::admin.partials.menu_item', ['menu_item' => null, 'menu_id' => $menu->id])
            </div>
        </div>
    @endif
@endsection
