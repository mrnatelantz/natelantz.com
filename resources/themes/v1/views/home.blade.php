<!DOCTYPE html>
<html>
<head>
    <title>Nate Lantz</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
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
</head>
<body>

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
        <h3 class="text-center">What I've been up to</h3>
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
</div>
</body>
</html>
