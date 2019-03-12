@extends('layouts.app')

@if(count($user) > 0)
  @section('title', $user->name)
@endif

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
              @if(count($user) > 0)
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.user-profile',['user'=>$user])
                    @endcomponent
                </div>
              @else
                <div class="panel-body">
                    No Related Data Found.
                </div>
              @endif
            </div>
            <br/>
            {{--
            @if($user->role == "student")
            <h4>Board Exams</h4>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              @if(count($user->studentBoardExam) > 0)
                @foreach($user->studentBoardExam as $exam)
                    @component('components.user-board-exam',[
                        'exam_name'=>$exam['exam_name'],
                        'group'=>$exam['group'],
                        'roll'=>$exam['roll'],
                        'registration'=>$exam['registration'],
                        'session'=>$exam['session'],
                        'board'=>$exam['board'],
                        'passing_year'=>$exam['passing_year'],
                        'institution_name'=>$exam['institution_name'],
                        'gpa'=>$exam['gpa'],
                    ])
                    @endcomponent
                @endforeach
              @endif
            <br/>
            <br/>
            </div>
            @endif--}}
        </div>
    </div>
</div>
@endsection
