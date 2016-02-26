@extends('radcms::layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-sm-6">
                <h4>Menus</h4>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            @yield('body')
        </div>
    </div>
@endsection