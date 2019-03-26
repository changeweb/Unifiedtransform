@extends('layouts.app')

@section('title', 'Admins')

@section('content')
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
    
@endsection
