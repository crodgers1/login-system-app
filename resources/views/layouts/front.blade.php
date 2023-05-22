<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login Access Software</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ URL::asset('assets/css/main.css'); }}" rel="stylesheet" type='text/css'>
        
    </head>
    <body>
        @if (!empty($message) && $message[0] == 'error')
            <div class='error_bar'>Error: {{$message[1]}}</div>
        @elseif (!empty($message) && $message[0] == 'message')
            <div class='message_bar'>Message: {{$message[1]}}</div>
        @endif

        @section('topbar')
            Login Access.
        @show
 
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
