@extends('layouts.app')

@section('title', 'All Classes and Sections')

@section('content')
<style>
    #cls-sec .panel{
        margin-bottom: 0%;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <h2>All Classes and Sections</h2>
            <div class="panel panel-default" id="cls-sec">
              @if(count($classes) > 0)
                @foreach ($classes as $class)
                    <div class="panel panel-default">
                        <div class="page-panel-title" role="tab" id="heading{{$class->id}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$class->id}}" aria-expanded="false" aria-controls="collapse{{$class->id}}">{{$class->class_number}} {{ucfirst($class->group)}}</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$class->id}}" aria-expanded="false" aria-controls="collapse{{$class->id}}"><small><b>Click to view all Sections under this Class <i class="material-icons">keyboard_arrow_down</i></b></small></a>
                                    </div>
                                    @if(isset($_GET['course']) && $_GET['course'] == 1)
                                    <div class="col-md-4">
                                        <a role="button" class="btn btn-info btn-xs" href="{{url('academic/syllabus')}}"><i class="material-icons">visibility</i> View Syllabus for this Class</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div id="collapse{{$class->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$class->id}}">
                            <div class="panel-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Section Name</th>
                                            @if(isset($_GET['att']) && $_GET['att'] == 1)
                                            <th>View Today's Attendance</th>
                                            <th>View Each Student's Attendance</th>
                                            <th>Give Attendance</th>
                                            @endif
                                            @if(isset($_GET['course']) && $_GET['course'] == 1)
                                            <th>View Courses</th>
                                            <th>View Students</th>
                                            <th>View Routines</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sections as $section)
                                            @if($class->id == $section->class_id)
                                            <tr>
                                            <td>
                                                <a href="{{url('courses/0/'.$section->id)}}">{{$section->section_number}}</a>
                                            </td>
                                            @if(isset($_GET['att']) && $_GET['att'] == 1)
                                                @foreach ($exams as $ex)
                                                    @if ($ex->class_id == $class->id)
                                                        <td>
                                                            <a role="button" class="btn btn-primary btn-xs" href="{{url('attendances/'.$section->id.'/0/'.$ex->exam_id)}}"><i class="material-icons">visibility</i> View Today's Attendance</a>
                                                        </td>
                                                    @endif
                                                @endforeach
                                            <td>
                                                <a role="button" class="btn btn-danger btn-xs" href="{{url('attendances/'.$section->id)}}"><i class="material-icons">visibility</i> View Each Student's Attendance</a>
                                            </td>
                                            <td>
                                                <?php
                                                    $ce = 0;    
                                                ?>
                                                @foreach ($exams as $ex)
                                                    @if ($ex->class_id == $class->id)
                                                        <?php
                                                            $ce = 1;
                                                        ?>
                                                        <a role="button" class="btn btn-info btn-xs" href="{{url('attendances/'.$section->id.'/0/'.$ex->exam_id)}}"><i class="material-icons">spellcheck</i> Take Attendance</a>
                                                    @endif
                                                @endforeach
                                                @if($ce == 0)
                                                    Assign Class Under Exam
                                                @endif
                                            </td>
                                            @endif
                                            @if(isset($_GET['course']) && $_GET['course'] == 1)
                                            <td>
                                                <a role="button" class="btn btn-info btn-xs" href="{{url('courses/0/'.$section->id)}}"><i class="material-icons">visibility</i> View Courses under this section</a>
                                            </td>
                                            <td>
                                                <a role="button" class="btn btn-danger btn-xs" href="{{url('section/students/'.$section->id.'?section=1')}}"><i class="material-icons">visibility</i> View Students of this section</a>
                                            </td>
                                            <td>
                                                <a role="button" class="btn btn-primary btn-xs" href="{{url('academic/routine')}}"><i class="material-icons">visibility</i> View Routines for this section</a>
                                            </td>
                                            @endif
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
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
