@extends('layouts.app')

@section('title', __('Students'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
              @if(count($users) > 0)
              <div class="page-panel-title">{{ucfirst($type)}} Students in {{date("Y")}}</div>
                <div class="panel-body">
                   
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- @component('components.tct-users-list',['users'=>$users,'current_page'=>$current_page,'per_page'=>$per_page]) --}}
                    @component('components.tct-users-list',['users'=>$users, 'type'=>$type])
                    @endcomponent
                </div>
              @else
                <div class="panel-body">
                    @lang('No Related Data Found.')
                </div>
              @endif
            </div>

        </div>
    </div>
    <div class="row">
        {{-- @foreach($users as $user) --}}
            {{-- {{$user}}<hr> --}}
        {{-- @endforeach --}}
    </div>
</div>
@endsection

@section('jsFiles')
{{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> --}}
{{-- <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"> --}}
{{-- </script> --}}
<script>
    $(document).ready( function () {
        // $('#myTable').DataTable();
    } );
</script>
@endsection
