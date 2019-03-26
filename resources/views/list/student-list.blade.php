@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <div class="col-md-10" id="main-container">
        <div class="panel panel-default">
          @if(count($users) > 0)
            @if (Session::has('section-attendance'))
                <ol class="breadcrumb" style="margin-top: 3%;">
                    <li><a href="{{url('school/sections?att=1')}}" style="color:#3b80ef;">Classes &amp; Sections</a></li>
                    <li class="active">{{ucfirst($users[0]->role)}}s</li>
                </ol>
            @endif
            <div class="page-panel-title">List of all {{ucfirst($user[0]->role)}}s</div>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @component('components.users-list',
                    [
                        'users'=>$users, 
                        'add_new_url'=> url('/register/student'),
                        'current_page'=>$current_page,
                        'per_page'=>$per_page
                    ])
                @endcomponent
            </div>
          @else
            @component('components.add-new',['url'=> url('/register/student')])
            @endcomponent
          @endif
        </div>
    </div>
@endsection
