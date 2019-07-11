@extends('layouts.app')

@section('title', __('Attendance'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            @if(count($attendances) > 0)
                @if(Auth::user()->role != 'student')
                <ol class="breadcrumb" style="margin-top: 3%;">
                    <li><a href="{{url('school/sections?att=1')}}" style="color:#3b80ef;">@lang('Classes') &amp; @lang('Sections')</a></li>
                    <li><a href="{{url()->previous()}}" style="color:#3b80ef;">@lang('List of Students')</a></li>
                    <li class="active">@lang('View Attendance')</li>
                </ol>
                @endif
                <h2>@lang('Attendance of Student') -  {{$attendances[0]->student->name}}</h2>
            @endif
            <div class="panel panel-default">
                @if(count($attendances) > 0)
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if(count($attendances) > 0)
                        <div class="col-md-4">
                            <h5>@lang('Attendance List of This Term')</h5>
                            <table class="table table-striped table-hover table-condensed">
                                <tr>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Date')</th>
                                </tr>
                                @foreach ($attendances as $attendance)
                                    {{-- @if($loop->index >= 30)
                                        @break;
                                    @endif --}}
                                    @if($attendance->present == 1)
                                    <tr class="success">
                                        <td>@lang('Present')</td>
                                        <td>{{$attendance->created_at->format('M d Y h:i:sa')}}</td>
                                    </tr>
                                    @elseif($attendance->present == 2)
                                    <tr class="warning">
                                        <td>@lang('Escaped')</td>
                                        <td>{{$attendance->created_at->format('M d Y h:i:sa')}}</td>
                                    </tr>
                                    @else
                                    <tr class="danger">
                                        <td>@lang('Absent')</td>
                                        <td>{{$attendance->created_at->format('M d Y h:i:sa')}}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    @endif

                    @include('layouts.student.attendances-table')
                </div>
                @else
                <div class="panel-body">
                    @lang('No Related Data Found.')
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
