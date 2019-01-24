<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/global.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>
<body>
    <div id="app">
        @include('layouts.components.fragments.welcome_navbar')
        <div class="row">
            @include('layouts.components.fragments.sidebar')
            @include('layouts.components.fragments.cashier_system')
            
        </div>
    </div>

    <!-- Scripts -->
    <script>
        $('#checkout').addClass('disabled');
    </script>
    
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    {{-- <script src="{{ asset('js/global.js') }}"></script> --}}
    
    
    @include('layouts.components.fragments.javascripts')
</body>
</html>
