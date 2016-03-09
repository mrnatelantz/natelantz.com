@extends('menu::admin.layouts.app')

@section('body')
    @if(isset($menu))

        <input class="form-control" value="{{ $menu->name or null }}">

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
