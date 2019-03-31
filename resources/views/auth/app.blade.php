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
        'librarian'))?Auth::user()->school->name:'Laravel' }}</title>
    <style>
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 999999;
            background: url({{asset('01-progress.gif')}}) 50% 50% no-repeat rgb(249,249,249);
        }
    </style>

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
    <div class="loader"></div>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse"
                        aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}" style="color: #000;">
                        {{ (Auth::check() && (Auth::user()->role == 'student' || Auth::user()->role == 'teacher' ||
                        Auth::user()->role == 'admin' || Auth::user()->role == 'accountant' || Auth::user()->role ==
                        'librarian'))?Auth::user()->school->name:'Laravel' }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                        <li><a href="{{ route('login') }}" style="color: #000;">Login</a></li>
                        @else
                        @if(\Auth::user()->role == 'student')
                        <li class="nav-item">
                            <a href="{{url('user/'.\Auth::user()->id.'/notifications')}}" class="nav-link nav-link-align-btn"
                                role="button">
                                <i class="material-icons text-muted">email</i>
                                <?php
                                        $mc = \App\Notification::where('student_id',\Auth::user()->id)->where('active',1)->count();
                                    ?>
                                @if($mc > 0)
                                <span class="label label-danger" style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">{{$mc}}</span>
                                @endif
                            </a>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle nav-link-align-btn" data-toggle="dropdown" role="button"
                                aria-expanded="false" aria-haspopup="true">
                                <span class="label label-danger">
                                    {{ ucfirst(\Auth::user()->role) }}
                                </span>&nbsp;&nbsp;
                                @if(!empty(Auth::user()->pic_path))
                                <img src="{{asset('01-progress.gif')}}" data-src="{{url(Auth::user()->pic_path)}}" alt="Profile Picture"
                                    style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">
                                @else
                                @if(strtolower(Auth::user()->gender) == 'male')
                                <img src="{{asset('01-progress.gif')}}" data-src="https://png.icons8.com/dusk/200/000000/user.png"
                                    alt="Profile Picture" style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">
                                @else
                                <img src="{{asset('01-progress.gif')}}" data-src="https://png.icons8.com/dusk/200/000000/user-female.png"
                                    alt="Profile Picture" style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">
                                @endif
                                @endif
                                &nbsp;&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                @if(Auth::user()->role != 'master')
                                <li>
                                    <a href="{{url('user/'.Auth::user()->student_code)}}">Profile</a>
                                </li>
                                @endif
                                <li>
                                    <a href="{{url('user/config/change_password')}}">Change Password</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
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

    <style>
        .navbar-default .navbar-toggle .icon-bar {
            background-color: #888;
        }

        body {
            color: #5f6368;
        }

        #app {
            background-color: #FFF;
        }

        a {
            color: #5f6368;
        }

        a:hover,
        a:focus {
            color: #202124;
        }

        .panel {
            box-shadow: none;
        }

        .panel-default {
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
        }

        .text-white {
            color: #fff !important;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-primary {
            background-color: #007bff !important;
        }

        .bg-secondary {
            background-color: #6c757d !important;
        }

        .bg-success {
            background-color: #28a745 !important;
        }

        .bg-danger {
            background-color: #dc3545 !important;
        }

        .bg-warning {
            background-color: #ffc107 !important;
        }

        .bg-info {
            background-color: #17a2b8 !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .bg-dark {
            background-color: #343a40 !important;
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
        }

        .card-title {
            margin-bottom: .75rem;
        }

        .card-body {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
        }

        .card-text:last-child {
            margin-bottom: 0;
        }

        @font-face {
            font-family: 'Material Icons';
            font-style: normal;
            font-weight: 400;
            src: url('{{asset('css/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.woff2')}}') format('woff2');
        }

        .material-icons {
            vertical-align: middle;
            /* new */
            font-family: 'Material Icons';
            font-weight: normal;
            font-style: normal;
            font-size: 20px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
            display: inline;
        }

        .navbar {
            margin-bottom: 0px;
            border-bottom: 1px solid #e6e5e5;
        }

        .navbar-default {
            background-color: #ffffff;
        }

        .navbar-default .navbar-nav>li>a,
        .navbar-default .navbar-nav>li>a:hover,
        .navbar-default .navbar-nav>li>a:focus,
        .navbar-default .navbar-nav>li>a:active,
        .navbar>.container .navbar-brand,
        .navbar>.container-fluid .navbar-brand {
            color: #000 !important;
        }

        #side-navbar {
            background-color: #fff;
            padding-top: 1%;
            padding-right: 0%;
            font-size: 13px;
            font-weight: bold;
        }

        #main-container {}

        .navbar-nav .open .dropdown-menu {
            background-color: #fff;
        }

        .navbar-default .navbar-nav .open .dropdown-menu>li>a {
            color: #000;
        }

        .navbar-default .navbar-nav .open .dropdown-menu>.active>a {
            color: #fff;
        }

        .navbar-default .navbar-nav>.open>a,
        .navbar-default .navbar-nav>.open>a:hover,
        .navbar-default .navbar-nav>.open>a:focus {
            color: #000;
            background-color: #f9fafa;
        }

        .dropdown-menu>li>a:hover,
        .dropdown-menu>li>a:focus {
            color: #000;
            background-color: #f9fafa;
        }

        .navbar-default .navbar-nav>.active>a,
        .navbar-default .navbar-nav>.active>a:hover,
        .navbar-default .navbar-nav>.active>a:focus {
            background-color: #f9fafa;
        }

        .page-panel-title {
            font-size: 2rem;
            padding: 1%;
        }

        .pagination {
            margin: 0px !important;
        }

        .table th {
            font-size: 12px;
        }

        .nav-link-align-btn {
            color: #000;
            padding-top: 0px !important;
            padding-bottom: 0px !important;
            line-height: 60px !important;
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