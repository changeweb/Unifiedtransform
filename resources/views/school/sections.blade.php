@extends('layouts.app')

@section('title', __('All Classes and Sections'))

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
            <h4>@lang('All Classes and Sections')</h4>
            <br>
            <a href="{{url('students/export/tct')}}" class="btn btn-sm btn-success"><i class="material-icons">import_export</i> Export all classes</a>
            @include('layouts.master.add-class-form') <!--NEW FORM BUTTON -->
            <hr>
            <div class="panel panel-default" id="cls-sec">
                <div class="panel panel-default">
                    <div class="page-panel-title" role="tab" id="headers">
                        <div class="row">
                            <div class="col-md-2 text-center"><h5>Form</h5></div>
                            <div class="col-md-3 text-center"><h5>Number of Sections</h5></div>
                            {{-- <div class="col-md-1 text-center"><h5>Last Session</h5></div> --}}
                            <div class="col-md-3 text-center"><h5>View Sections</h5></div>
                            {{-- <div class="col-md-2 text-center"><h5>Syllabus</h5></div> --}}
                            <div class="col-md-2 text-center"><h5>Edit</h5></div>
                        </div>
                    </div>
                </div>
              @if(count($classes) > 0)
                @foreach ($classes as $class)
                    <div class="panel panel-default">
                        <div class="page-panel-title" role="tab" id="heading{{$class->id}}">
                                <div class="row">
                                    <div class="col-md-2 text-center">
                                        <a class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$class->id}}" aria-expanded="false" aria-controls="collapse{{$class->id}}">{{$class->class_number}} {{ucfirst($class->group)}}</a>
                                    </div>
                                    <div class="col-md-3">
                                        @php
                                            $output = $class->sections()->count('id');
                                            $msg = (($output == 0)? '-': (($output == 1)? '1 section': $output.' sections'));
                                            // $active = $class->sections()->where('active', 1)->count('id');
                                            // ({{$active}} / {{$output - $active}})
                                        @endphp
                                        <h6 class='text-center'>{{$msg}} </h6>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <a class="panel-title collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$class->id}}" aria-expanded="false" aria-controls="collapse{{$class->id}}"><small><b>@lang('Click to view') <i class="material-icons">keyboard_arrow_down</i></b></small></a>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        @include('layouts.master.edit-class-form')
                                    </div>
                                </div>
                        </div>
                        <div id="collapse{{$class->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$class->id}}">
                            <div class="panel-body">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">@lang('Section Name')</th>
                                            @if(isset($_GET['att']) && $_GET['att'] == 1)
                                            <th class="text-center">@lang('View Today\'s Attendance')</th>
                                            <th class="text-center">@lang('View Each Student\'s Attendance')</th>
                                            <th class="text-center">@lang('Give Attendance')</th>
                                            {{-- <th class="text-center">@lang('Edit')</th> --}}
                                            @endif
                                            @if(isset($_GET['course']) && $_GET['course'] == 1)
                                            <th class="text-center">@lang('Active')</th>
                                            <th class="text-center">@lang('Student Count')</th>
                                            {{-- <th class="text-center">@lang('Last Session')</th> --}}
                                            {{-- <th class="text-center">@lang('View Courses')</th> --}}
                                            <th class="text-center">@lang('View Students')</th>
                                            {{-- <th class="text-center">@lang('View Routines')</th> --}}
                                            <th class="text-center">@lang('Edit')</th>
                                            {{-- <th class="text-center">@lang('Promotion')</th> --}}

                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sections as $section)
                                            @if($class->id == $section->class_id)
                                                <tr>
                                                    <td class="text-center">
                                                        {{-- <a class="text-center" href="{{url('courses/0/'.$section->id)}}">{{$section->section_number}}</a> --}}
                                                        {{$section->section_number}}
                                                    </td>
                                                    @if(isset($_GET['att']) && $_GET['att'] == 1)
                                                        @foreach ($exams as $ex)
                                                            @if ($ex->class_id == $class->id)
                                                                <td>
                                                                    <a role="button" class="btn btn-primary btn-xs" href="{{url('attendances/'.$section->id.'/0/'.$ex->exam_id)}}">@lang('Attendance')</a>
                                                                </td>
                                                            @endif
                                                        @endforeach
                                                        {{-- ATTENDANCE --}}
                                                        <td>
                                                            <a role="button" class="btn btn-danger btn-xs" href="{{url('attendances/'.$section->id)}}">@lang('Attendance')</a>
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
                                                                    <a role="button" class="btn btn-info btn-xs" href="{{url('attendances/'.$section->id.'/0/'.$ex->exam_id)}}"><i class="material-icons">spellcheck</i> @lang('Take Attendance')</a>
                                                                @endif
                                                            @endforeach
                                                            @if($ce == 0)
                                                                @lang('Assign Class Under Exam')
                                                            @endif
                                                        </td>
                                                    @endif
                                                    @if(isset($_GET['course']) && $_GET['course'] == 1)
                                                        <td class="text-center">{{($section->active)?"Yes":"No"}}</td>
                                                        @php
                                                            $studentCount = \App\StudentInfo::where('form_id', $section->id)
                                                            ->where('session', now()->year)
                                                            ->count('id');
                                                        @endphp
                                                        <td class="text-center">{{($section->active)?$studentCount:'-'}}</td>
                                                        {{-- <td class="text-center"></td> --}}
                                                        {{-- <td class="text-center">
                                                            <a role="button" class="btn btn-info btn-xs" href="{{url('courses/0/'.$section->id)}}"><i class="material-icons">visibility</i> @lang('View Courses')</a>
                                                        </td> --}}
                                                        <td class="text-center">
                                                            <a role="button" class="btn btn-primary btn-xs" href="{{url('section/tct_students/'.$section->id.'?section=1')}}"><i class="material-icons">visibility</i> @lang('View Students')</a>
                                                        </td>
                                                        {{-- <td class="text-center">
                                                            <a role="button" class="btn btn-warning btn-xs" href="{{url('academic/routine/'.$section->id)}}"><i class="material-icons">visibility</i> @lang('View Routines')</a>
                                                        </td> --}}
                                                        <td class="text-center">
                                                            @include('layouts.master.edit-sections-form')
                                                        </td>
                                                        {{-- <td class="text-center">
                                                            <a  class="btn btn-xs btn-success" href="{{url('school/promote-students/'.$section->id)}}">+ @lang('Promote Students')</a>
                                                        </td> --}}
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                @include('layouts.master.create-section-form')
                            </div>
                        </div>
                    </div>
                @endforeach
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
