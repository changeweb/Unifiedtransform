@extends('layouts.app')

@section('title', __('Attendance'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <ol class="breadcrumb" style="margin-top: 3%;">
                <li><a href="{{url('school/sections?att=1')}}" style="color:#3b80ef;">@lang('All Classes') &amp; @lang('Sections')</a></li>
                <li class="active">@lang('Attendance')</li>
            </ol>
            <h2>@lang('Take Attendance')</h2>
            <div class="panel panel-default">
                @if(count($students) > 0)
                @foreach ($students as $student)
                  <div class="page-panel-title">
                    <b>Section</b> - {{ $student->section->section_number}} &nbsp; <b>Class</b> - {{$student->section->class->class_number}}
                    <span class="pull-right"><b>@lang('Current Date Time'):</b> &nbsp;{{ Carbon\Carbon::now()->format('h:i A d/m/Y')}}</span>
                  </div>
                   @break($loop->first)
                @endforeach
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('layouts.teacher.attendance-form')
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
