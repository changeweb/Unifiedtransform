@extends('layouts.app')

@section('title', 'Accountants')

@section('content')
    <div class="col-md-10" id="main-container">
        <div class="panel panel-default">
          @if(count($users) > 0)
            <div class="page-panel-title">List of all {{ucfirst($users[0]->role)}}s</div>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @component('components.users-list',
                  [
                    'users'=>$users, 
                    'add_new_url'=> url('register/accountant'),
                    'current_page'=>$current_page,
                    'per_page'=>$per_page
                  ])
                @endcomponent
            </div>
          @else
            @component('components.add-new',['url'=> url('register/accountant')])
            @endcomponent
          @endif
        </div>
    </div>
@endsection
