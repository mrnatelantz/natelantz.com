@extends('radcms::layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-sm-6">
                <h4>Menu</h4>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('menu.create') }}" class="btn btn-success pull-right">New</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            @yield('body')
        </div>
    </div>
@endsection