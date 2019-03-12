@extends('layouts.app')

@section('title', 'Admins')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('create-school')}}"><i class="material-icons">gamepad</i> Manage School</a>
                </li>
            </ul>
        </div>
        <div class="col-md-8" id="main-container">
            <h2>Admins</h2>
            <div class="panel panel-default">
              @if(count($admins) > 0)
                <div class="panel-body">
                    <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                    </tr>   
                    @foreach ($admins as $admin)
                    <tr> 
                        <td>
                            {{$admin->name}}
                        </td>
                        <td>{{$admin->student_code}}</td>
                        <td>{{$admin->email}}</td>
                        <td>{{$admin->phone_number}}</td>
                    </tr>
                    @endforeach
                    </table>
                </div>
              @else
                <div class="panel-body">
                    No Related Data Found.
                </div>
              @endif
            </div>
          </div>
    </div>
</div>
@endsection
