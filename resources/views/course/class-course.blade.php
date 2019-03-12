@extends('layouts.app')

@section('title', 'Course')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            @if(Auth::user()->role != 'student')
            <ol class="breadcrumb" style="margin-top: 3%;">
                <li><a href="{{url('school/sections?course=1')}}" style="color:#3b80ef;">All Classes &amp; Sections</a></li>
                <li class="active">Courses</li>
            </ol>
            @endif
            <h2>Courses Related to Section</h2>
            <div class="panel panel-default">
              @if(count($courses) > 0)
                @foreach ($courses as $course)
                    <div class="page-panel-title"><b>Section</b> -   {{$course->section->section_number}} &nbsp;<b>Class</b> -  {{$course->section->class->class_number}}</div>
                    @break($loop->first)
                @endforeach
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.course-table',['courses'=>$courses, 'exams'=>$exams, 'student'=>(Auth::user()->role == 'student')?true:false])
                    @endcomponent
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
