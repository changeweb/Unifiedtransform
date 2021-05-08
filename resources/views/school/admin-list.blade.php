@extends('layouts.app')

@section('title', __('Admins'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('schools.index') }}"><i class="material-icons">gamepad</i> @lang('Manage School')</a>
                </li>
            </ul>
        </div>
        <div class="col-md-10" id="main-container">
            <h2>Admins</h2>
            <div class="panel panel-default">
                @if(count($admins) > 0)
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>@lang('Action')</th>
                            <th>@lang('Action')</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Code')</th>
                            <th>@lang('Email')</th>
                            <th>@lang('Phone Number')</th>
                            <th>@lang('Address')</th>
                            <th>@lang('About')</th>
                        </tr>
                        @foreach ($admins as $admin)
                        <tr>
                            <td>
                                @if($admin->active == 0)
                                <a href="{{url('master/activate-admin/'.$admin->id)}}" class="btn btn-xs btn-success"
                                    role="button"><i class="material-icons">
                                        done
                                    </i>@lang('Activate')</a>
                                @else
                                <a href="{{url('master/deactivate-admin/'.$admin->id)}}" class="btn btn-xs btn-danger"
                                    role="button"><i class="material-icons">
                                        clear
                                    </i>@lang('Deactivate')</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{url('edit/user/'.$admin->id)}}" class="btn btn-xs btn-info"
                                    role="button"><i class="material-icons">
                                        edit
                                    </i> @lang('Edit')</a>
                            </td>
                            <td>
                                {{$admin->name}}
                            </td>
                            <td>{{$admin->student_code}}</td>
                            <td>{{$admin->email}}</td>
                            <td>{{$admin->phone_number}}</td>
                            <td>{{$admin->address}}</td>
                            <td>{{$admin->about}}</td>
                        </tr>
                        @endforeach
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
