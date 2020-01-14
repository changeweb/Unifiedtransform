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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
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
    <script src="{{asset('js/typeahead.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function($){
            // Set the Options for the 'Bloodhound' suggestion engine
            $(document).ready( function () {
                // $('#myTable').DataTable();
            } );

            var engine = new Bloodhound({
                remote: {
                    url: "{{url('/find?q=%QUERY%')}}",
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });
            $(".search-input").typeahead({
                hint: true,
                highlight: true,
                minLength: 1,
                limit: 20,
            }, {
                source: engine.ttAdapter(),
                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'studentsList',

                // the key from the array we want to display (name,id,email,etc...)
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown">'
                    ],
                    suggestion: function (data) {
                        // return '<a href= "/lsapp/public/allStudent/'+ data.tct_id +'" class="list-group-item">
                        return '<a href= "{{url("/user/")}}/' + data.student_code +'" class="list-group-item"><b><small>'+ data.student_code + "<p></small></b>" + data.given_name + ' ' + data.lst_name + '</p></a>'
                    }
                }
            });
        });  

    </script>
        @yield('jsFiles')
</body>

</html>
