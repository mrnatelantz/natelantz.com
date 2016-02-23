@extends('radcms::layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="col-sm-6">
                <h4>Pages</h4>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('pages.create.get') }}" class="btn btn-success pull-right">New</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            @yield('body')
        </div>
    </div>
@endsection