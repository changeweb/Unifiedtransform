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

    <script src="{{asset('js/jquery-2.1.3.min.js')}}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>

<body>
    @include('components.loader')
    <div id="app">
        @include('components.navbar-top')
        @yield('content')
    </div>
    <!-- Styles -->
    <!-- Latest compiled and minified CSS -->
    {{--
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}" id="bootstrap-print-id"> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous" id="bootstrap-print-id">
    <link href="{{asset('css/flatly.bootstrap-3.3.7.min.css') }}" rel="stylesheet" id="bootswatch-print-id">
    <link href="{{asset('css/dataTables-1.10.16.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{asset('css/app-layout.css') }}" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Material Icons';
            font-style: normal;
            font-weight: 400;
            src: url('{{asset("css/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.woff2")}}') format('woff2');
        }
    </style>
    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap-3.3.7.min.js') }}"></script>
    <script src="{{ asset('js/dataTables-1.10.16.min.js') }}"></script>
    <script src="{{ asset('js/dataTables-1.10.16.bootstrap.min.js') }}"></script>

    <script>
        $(window).load(function () {
            $('.loader').fadeOut();
        });
        $(document).ready(function () {
            var myTable = $('.table-data-div').DataTable({
                paging: false,
            });
        });
        window.addEventListener('load', function () {
            var allimages = document.getElementsByTagName('img');
            for (var i = 0; i < allimages.length; i++) {
                if (allimages[i].getAttribute('data-src')) {
                    allimages[i].setAttribute('src', allimages[i].getAttribute('data-src'));
                }
            }
        }, false);
    </script>
</body>

</html>
