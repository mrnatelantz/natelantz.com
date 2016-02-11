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
                <h4 class="text-center">Things I've been working on</h4>
                <hr>
                @for ($i = 0; $i < 15; $i++)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 text-center">
                        <img src="http://placehold.it/250x250" class="img-responsive img-rounded center-block" alt="Profile Pic">
                        <span class="text-center">{{ $i }}</span>
                    </div>
                @endfor
            </div>
        </div>
    </body>
</html>
