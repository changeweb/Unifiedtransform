@extends('layouts.app')

@section('title', 'Teachers')

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

                @component('components.users-list',['users'=>$users, 'add_new_url'=> url('/register/teacher'),'current_page'=>$current_page,'per_page'=>$per_page])
                @endcomponent
            </div>
          @else
            @component('components.add-new',['url'=> url('/register/teacher')])
            @endcomponent
          @endif
        </div>
    </div>
@endsection
