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
                    @lang('No Related Data Found.')
                </div>
              @endif
            </div>
            <br/>
            @if($user->role == "student")
            <h4>Board Exams</h4>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @component('components.user-board-exam',[
            'exam_name'=>'PSC',
            'group'=>$user->psc_group,
            'roll'=>$user->psc_roll,
            'registration'=>$user->psc_registration,
            'session'=>$user->psc_session,
            'board'=>$user->psc_board,
            'passing_year'=>$user->psc_passing_year,
            'institution_name'=>$user->psc_institution_name,
            'gpa'=>$user->psc_gpa,
            ])
            @endcomponent
            @component('components.user-board-exam',[
            'exam_name'=>'JSC',
            'group'=>$user->jsc_group,
            'roll'=>$user->jsc_roll,
            'registration'=>$user->jsc_registration,
            'session'=>$user->jsc_session,
            'board'=>$user->jsc_board,
            'passing_year'=>$user->jsc_passing_year,
            'institution_name'=>$user->jsc_institution_name,
            'gpa'=>$user->jsc_gpa,
            ])
            @endcomponent
            @component('components.user-board-exam',[
            'exam_name'=>'SSC',
            'group'=>$user->ssc_group,
            'roll'=>$user->ssc_roll,
            'registration'=>$user->ssc_registration,
            'session'=>$user->ssc_session,
            'board'=>$user->ssc_board,
            'passing_year'=>$user->ssc_passing_year,
            'institution_name'=>$user->ssc_institution_name,
            'gpa'=>$user->ssc_gpa,
            ])
            @endcomponent
            @component('components.user-board-exam',[
            'exam_name'=>'HSC',
            'group'=>$user->hsc_group,
            'roll'=>$user->hsc_roll,
            'registration'=>$user->hsc_registration,
            'session'=>$user->hsc_session,
            'board'=>$user->hsc_board,
            'passing_year'=>$user->hsc_passing_year,
            'institution_name'=>$user->hsc_institution_name,
            'gpa'=>$user->hsc_gpa,
            ])
            @endcomponent
            @endif
            <br/>
            <br/>
          </div>
        </div>
    </div>
</div>
@endsection
