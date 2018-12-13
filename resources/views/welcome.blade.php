<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <style>
        body {
        background-color: #0b0f27;
        margin: 0px;
        }
        </style>
        <title>testio</title>

    </head>
    <body class="cover screen">
           @if (!empty(Session::get('auth')))
            <script>window.location = "/list";</script>                   
           @else
           <div class="center-items screen">
                <div class="login-logo"></div>
                <input type="button" value="Login With GitHub" class="btn login-button" onclick="window.location.href='/login'">
            </div>
           @endif
      
    </body>
</html>
