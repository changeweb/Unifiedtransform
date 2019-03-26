@extends('layouts.app')

@section('title', 'Grade')

@section('content')
        <div class="col-md-8" id="main-container">
            @if(Auth::user()->role != 'student')
            <ol class="breadcrumb" style="margin-top: 3%;">
                <li><a href="{{url('grades/all-exams-grade')}}" style="color:#3b80ef;">Grades</a></li>
                <li class="active">Section Grade</li>
            </ol>
            @endif
            <h2>Marks and Grades</h2>
            <div class="panel panel-default">
              @if(count($grades) > 0)
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($grades as $grade)
                        <b>Class:</b> {{$grade->course->class->class_number}} &nbsp;
                        <b>Section:</b> {{$grade->student->section->section_number}}
                        @break
                    @endforeach
                    <table class="table table-data-div table-bordered table-striped">
                        <thead>
                        <tr>
                            <th scope="row">Exam Name</th>
                            <th scope="row">Course Name</th>
                            <th scope="row">Student Code</th>
                            <th scope="row">Student Name</th>
                            <th scope="row">Total Mark</th>
                            <th scope="row">GPA</th>
                        </tr>
                        </thead>
                        <tbody>
                    @foreach($grades as $grade)
                        <tr>
                            <td>{{$grade->exam->exam_name}}</td>
                            <td>{{$grade->course->course_name}}</td>
                            <td>{{$grade->student->student_code}}</td>
                            <td><a href="{{url('user/'.$grade->student->student_code)}}">{{$grade->student->name}}</a></td>
                            <td>{{$grade->marks}}</td>
                            <td>{{$grade->gpa}}</td>
                        </tr>
                    @endforeach
                        </tbody>
                    </table>
                </div>
              @else
                <div class="panel-body">
                    No Related Data Found.
                </div>
              @endif
            </div>
        </div>
@endsection
