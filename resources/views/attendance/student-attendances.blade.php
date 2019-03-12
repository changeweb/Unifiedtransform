@extends('layouts.app')

@section('title', 'Attendance')

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
                    <li><a href="{{url('school/sections?att=1')}}" style="color:#3b80ef;">Classes &amp; Sections</a></li>
                    <li><a href="{{url()->previous()}}" style="color:#3b80ef;">List of Students</a></li>
                    <li class="active">View Attendance</li>
                </ol>
                @endif
                <h2>Attendance of Student -  {{$attendances[0]->student->name}}</h2>
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
                            <h5>Attendance List of This Term</h5>
                            <table class="table table-striped table-hover table-condensed">
                                <tr>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                                @foreach ($attendances as $attendance)
                                    {{-- @if($loop->index >= 30)
                                        @break;
                                    @endif --}}
                                    @if($attendance->present == 1)
                                    <tr class="success">
                                        <td>Present</td>
                                        <td>{{$attendance->created_at}}</td>
                                    </tr>
                                    @elseif($attendance->present == 2)
                                    <tr class="warning">
                                        <td>Escaped</td>
                                        <td>{{$attendance->created_at}}</td>
                                    </tr>
                                    @else
                                    <tr class="danger">
                                        <td>Absent</td>
                                        <td>{{$attendance->created_at}}</td>
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
                    No Related Data Found.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
