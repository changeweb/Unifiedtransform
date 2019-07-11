<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ (Auth::check() && (Auth::user()->role == 'student' || Auth::user()->role == 'teacher'
        || Auth::user()->role == 'admin' || Auth::user()->role == 'accountant' || Auth::user()->role ==
        'librarian'))?Auth::user()->school->name:config('app.name') }}</title>

    <link rel="stylesheet" href="{{ url('css/loader.css') }}">

    <script src="{{ url('js/vendors.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ url('js/application.js') }}"></script>
    @yield('after_scripts')
</head>

<body>
    @include('components.loader')
    <div id="app">
        @include('components.navbar-top')
        @yield('content')
    </div>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons&style=normal&weight=400"
      rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/vendors.css') }}" id="bootswatch-print-id">
    <link rel="stylesheet" href="{{ url('css/application.css') }}">
</body>

</html>
