@extends('layouts.app')

@section('title', 'Promote Section Students')

@section('content')
        <div class="col-md-10" id="main-container">
            <h2>Promote Students of</h2>
            <div class="panel panel-default">
              @if(count($students) > 0)
                @foreach ($students as $student)
                  <div class="page-panel-title">
                    <b>Section</b> - {{ $student->section->section_number}} &nbsp; <b>Class</b> - {{$student->section->class->class_number}}
                    <span class="pull-right"><b>Current Date Time:</b> &nbsp;{{ Carbon\Carbon::now()->format('h:i A d/m/Y')}}</span>
                  </div>
                   @break($loop->first)
                @endforeach
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @component('components.promote-students',['students'=>$students,'classes'=>$classes,'section_id'=>$section_id])
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
