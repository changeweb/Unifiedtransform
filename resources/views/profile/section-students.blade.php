@extends('layouts.app')

@section('title', __('Course Students'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <ol class="breadcrumb" style="margin-top: 3%;">
                @if(isset($_GET['grade']) && $_GET['grade'] == 1)
                    <li><a href="{{url('grades/all-exams-grade')}}" style="color:#3b80ef;">@lang('Grades')</a></li>
                @else
                    <li><a href="{{url('school/sections?course=1')}}" style="color:#3b80ef;">@lang('Section')</a></li>
                @endif
                <li class="active">@lang('Students')</li>
            </ol>
            <h2>@lang('Section Students')</h2>
            <div class="panel panel-default">
              @if(count($students) > 0)
                <div class="panel-body">
                    <table class="table table-data-div table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">@lang('Sl.')</th>
                            <th scope="col">@lang('Student Code')</th>
                            <th scope="col">@lang('Student Name')</th>
                            <th scope="col">@lang('Status')</th>
                            <th scope="col">@lang('Grade History')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <td>{{($loop->index+1)}}</td>
                            <td>{{$student->student_code}}</td>
                            <td><a href="{{url('user/'.$student->student_code)}}">{{$student->name}}</a></td>
                            <td>
                            @if($student->studentInfo['session'] == now()->year || $student->studentInfo['session'] > now()->year)
                            <span class="label label-success">@lang('Promoted/New')</span>
                            @else
                            <span class="label label-danger">@lang('Not Promoted')</span>
                            @endif
                            </td>
                            <td><a class="btn btn-xs btn-success" role="button" href="{{url('grades/'.$student->id)}}">@lang('View Grade History')</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
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
