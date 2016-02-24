@extends('layouts.app')

@push('css')
    <style>
        .main-header{
            background-color: #16a085;
            padding-top: 2%;
            padding-bottom: 2%;
        }

        .box{
            background-color: #3498db;
            width: 100%;
            min-height: 200px;
            padding: 3%;
            margin: 3%;
        }
        .box-text{
            background: rgba(0, 0, 0, 0.5);
            color: #FDFDFD;
            width: 100%;
            /*position: absolute;
            bottom: 0;
            margin-bottom: 4%;*/
        }

        .background-github {
            background-image: url('/img/code.png');
            background-size: cover;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12 main-header">
            <img src="http://placehold.it/250x250" class="img-responsive img-circle center-block" alt="Profile Pic">

            <div class="col-md-12 text-center">
                <h3>Nate Lantz</h3>
                <h5>Some Test, More Text, Last Text</h5>
                <a href="#" class="btn btn-primary">Send Me a Message</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <hr>
            @foreach ($activities as $activity)
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 text-center">
                    <a href="{{ $activity['url'] }}" target="_blank">
                        <div class="box background-{{ $activity['background_class'] }}">
                            <div class="box-text">
                                <span class="text-center">{{ $activity['name'] }}</span>
                            </div>
                    </a>
                </div>
        </div>
        @endforeach
    </div>
@endsection
