@extends('layouts.app')

@section('title', __('Grade'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            @if(Auth::user()->role != 'student')
            <ol class="breadcrumb" style="margin-top: 3%;">
                <li><a href="{{url('grades/all-exams-grade')}}" style="color:#3b80ef;">@lang('Grades')</a></li>
                <li><a href="{{url()->previous()}}" style="color:#3b80ef;">@lang('Section Students')</a></li>
                <li class="active">@lang('History')</li>
            </ol>
            @endif
            <h2>@lang('Marks and Grades History')</h2>
            <div class="panel panel-default">
              @if(count($grades) > 0)
              @foreach ($grades as $grade)
                <?php
                    $studentName = $grade->student->name;
                    $classNumber = $grade->student->section->class->class_number;
                    $sectionNumber = $grade->student->section->section_number;
                ?>
                <div class="page-panel-title"><b>@lang('Student Code')</b> - {{$grade->student->student_code}} &nbsp;<b>@lang('Name')</b> -  {{$grade->student->name}} &nbsp;<b>@lang('Class')</b> - {{$grade->student->section->class->class_number}} &nbsp;<b>@lang('Section')</b> - {{$grade->student->section->section_number}}</div>
                 @break($loop->first)
              @endforeach
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('layouts.student.grade-table')
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
