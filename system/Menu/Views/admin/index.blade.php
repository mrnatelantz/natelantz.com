@extends('menu::admin.layouts.app')

@section('body')
    @if(isset($menus))
        @foreach($menus as $menu)
            <div class="col-md-4">
                <a href="{{ route('menu.edit', ['id' => $menu->id]) }}">{{ $menu->name }}</a>
            </div>
        @endforeach
    @else
        <h4>No Menus Found</h4>
    @endif
@endsection