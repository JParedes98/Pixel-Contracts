<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--Favicon-->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PixelPay') }}</title>

    <!--FONT AWESOME-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom-styles.css') }}" rel="stylesheet">
    <link href="{{asset('/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">

</head>

<body class="">
    <div id="app">
        @yield('navbar')

        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/signature_pad.min.js') }}"></script>
    <script src="{{asset('/js/datepicker.min.js')}}"></script>
    <script src="{{asset('/js/i18n/datepicker.es.js')}}"></script>
    <script src="{{ asset('js/tabs.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @if (env('APP_ENV') == 'local')
        <script id="__bs_script__">//<![CDATA[
            document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.18.6'><\/script>".replace("HOST", location.hostname));
            //]]>
        </script>
    @endif
</body>

</html>
