@extends('layouts.app')

@section('title', 'Attendance')

@section('content')
        <div class="col-md-10" id="main-container">
            @if(count($attendances) > 0)
                @if(Auth::user()->role != 'student')
                <ol class="breadcrumb" style="margin-top: 3%;">
                    <li><a href="{{url('school/sections?att=1')}}" style="color:#3b80ef;">Classes &amp; Sections</a></li>
                    <li><a href="{{url()->previous()}}" style="color:#3b80ef;">List of Students</a></li>
                    <li class="active">View Attendance</li>
                </ol>
                @endif
                <h2>Adjust Attendance of Student -  {{$attendances[0]->student->name}}</h2>
            @endif
            <div class="panel panel-default">
                @if(count($attendances) > 0)
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.adjust-attendance',['attendances'=>$attendances,'student_id'=>$student_id])
                        
                    @endcomponent
                </div>
                @else
                <div class="panel-body">
                    No Related Data Found.
                </div>
                @endif
            </div>
        </div>
@endsection
