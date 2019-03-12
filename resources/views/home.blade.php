@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default" style="border-top: 0px;">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                      <div class="page-panel-title">Dashboard</div>
                      <div class="col-sm-2">
                        <div class="card text-white bg-primary mb-3">
                          <div class="card-header">Total Students - <b>{{$totalStudents}}</b></div>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="card text-white bg-success mb-3">
                          <div class="card-header">Total Teachers - <b>{{$totalTeachers}}</b></div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="card text-white bg-dark mb-3">
                          <div class="card-header">Total Types of Books In Library - <b>{{$totalBooks}}</b></div>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="card text-white bg-danger mb-3">
                          <div class="card-header">Total Classes - <b>{{$totalClasses}}</b></div>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="card text-white bg-info mb-3">
                          <div class="card-header">Total Sections - <b>{{$totalSections}}</b></div>
                        </div>
                      </div>
                    </div>
                    <p></p>
                    <div class="row">
                      <div class="col-sm-8">
                        <div class="panel panel-default" style="background-color: rgba(242,245,245,0.8);">
                          <div class="panel-body">
                            <h3>Welcome to {{Auth::user()->school->name}}</h3>
                            Your presence and cooperation will help us to improve the education system of our organization.
                          </div>
                        </div>
                        <div class="panel panel-default">
                          <div class="page-panel-title">Active Exams</div>
                          <div class="panel-body">
                            @if(count($exams) > 0)
                            <table class="table">
                              <tr>
                                <th>Exam Name</th>
                                <th>Notice Published</th>
                                <th>Result Published</th>
                              </tr>
                              @foreach($exams as $exam)
                              <tr>
                                <td>{{$exam->exam_name}}</td>
                                <td>{{($exam->notice_published === 1)?'Yes':'No'}}</td>
                                <td>{{($exam->result_published === 1)?'Yes':'No'}}</td>
                              </tr>
                              @endforeach
                            </table>
                            @else
                              No Active Examination
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="panel panel-default">
                          <div class="page-panel-title">Notices</div>
                          <div class="panel-body pre-scrollable">
                            @if(count($notices) > 0)
                              <div class="list-group">
                              @foreach($notices as $notice)
                                <a href="{{ url($notice->file_path)}}" class="list-group-item" target="_blank">{{$notice->title}}</a>
                              @endforeach
                              </div>
                            @else
                              No New Notice
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="panel panel-default">
                          <div class="page-panel-title">Events</div>
                          <div class="panel-body pre-scrollable">
                            @if(count($events) > 0)
                              <div class="list-group">
                              @foreach($events as $event)
                                <a href="{{ url($event->file_path)}}" class="list-group-item" target="_blank">{{$event->title}}</a>
                              @endforeach
                              </div>
                            @else
                              No New Event
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="panel panel-default">
                          <div class="page-panel-title">Routines</div>
                          <div class="panel-body pre-scrollable">
                            @if(count($routines) > 0)
                              <div class="list-group">
                              @foreach($routines as $routine)
                                <a href="{{ url($routine->file_path)}}" class="list-group-item" target="_blank">{{$routine->title}}</a>
                              @endforeach
                              </div>
                            @else
                              No New Routine
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="panel panel-default">
                          <div class="page-panel-title">Syllabus</div>
                          <div class="panel-body pre-scrollable">
                            @if(count($syllabuses) > 0)
                              <div class="list-group">
                                @foreach($syllabuses as $syllabus)
                                <a href="{{ url($syllabus->file_path)}}" class="list-group-item" target="_blank">{{$syllabus->title}}</a>
                                @endforeach
                              </div>
                            @else
                              No New Syllabus
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
