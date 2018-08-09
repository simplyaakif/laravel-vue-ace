<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="{{asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
        <link href="{{asset('lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
        <link href="{{asset('lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
        <link href="{{asset('lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
        <link href="{{asset('lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet">
        <link href="{{asset('lib/chartist/chartist.css')}}" rel="stylesheet">


        <link rel="stylesheet" href=" {{asset('css/app.css')}} ">
        <link rel="stylesheet" href=" {{asset('css/bracket.css')}} ">
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>

    <body>

        <div id="app">
            <app></app>
            {{-- <navbar></navbar> --}}
           
            {{-- <queries></queries> --}}
        </div>

            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

            {{-- <script src="{{asset('lib/jquery/jquery.js')}}"></script> --}}
            <script src="{{asset('lib/popper.js/popper.js')}}"></script>
            <script src="{{asset('lib/bootstrap/bootstrap.js')}}"></script>
            <script src="{{asset('lib/moment/moment.js')}}"></script>
            <script src="{{asset('lib/jquery-ui/jquery-ui.js')}}"></script>
            <script src="{{asset('lib/jquery-switchbutton/jquery.switchButton.js')}}"></script>
            <script src="{{asset('lib/peity/jquery.peity.js')}}"></script>
            <script src="{{asset('lib/chartist/chartist.js')}}"></script>
            <script src="{{asset('lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
            <script src="{{asset('lib/d3/d3.js')}}"></script>
            <script src="{{asset('lib/rickshaw/rickshaw.min.js')}}"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
            <script src="{{asset('lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
            {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/js/min/perfect-scrollbar.jquery.min.js"></script> --}}

            <script src="{{asset('js/bracket.js')}} "></script>
            <script src="{{asset('js/ResizeSensor.js')}} "></script>
            <script src="{{asset('js/dashboard.js')}} "></script>
        
    </body>
</html>
