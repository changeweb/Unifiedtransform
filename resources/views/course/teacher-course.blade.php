@extends('layouts.app')

@section('title', 'Course')

@section('content')
        <div class="col-md-10" id="main-container">
            <h2>Courses Taken by Teacher</h2>
            <div class="panel panel-default">
              @if(count($courses) > 0)
              @foreach ($courses as $course)
                <div class="page-panel-title" style="font-size: 20px;"><b>Teacher Code</b> - {{$course->teacher->student_code}} &nbsp;<b>Name</b> - <a href="{{url('user/'.$course->teacher->student_code)}}">{{$course->teacher->name}}</a></div>
                 @break($loop->first)
              @endforeach
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.course-table',['courses'=>$courses, 'exams'=>$exams, 'student'=>false])
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
