@extends('pages::admin.layouts.app')

@section('body')
    <form>
        {{ csrf_field() }}
    </form>
@endsection