@extends('layouts.app')

@section('title', 'Edit School')

@section('content')
<div class="container-fluid">
    <div class="row">
      @if(\Auth::user()->role != 'master')
        <div class="col-md-2" id="side-navbar">
          @include('layouts.leftside-menubar')
        </div>
      @endif
        <div class="col-md-{{ (\Auth::user()->role == 'master')? 12 : 10 }}" id="main-container">
            @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="panel panel-default">
              <div class="panel-body table-responsive">
                @if(\Auth::user()->role == 'master')
                    <h2>Edit {{$school->name}}</h2>

                    <form class="form-horizontal" action="{{url('school/' . $school->id)}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">School Name</label>
  
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $school->name }}" placeholder="Form Field Name" required>
  
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                            <label for="about" class="col-md-4 control-label">About School</label>
  
                            <div class="col-md-6">
                                <textarea id="about" type="text" class="form-control" name="about" 
                                    placeholder="Form Field Name" required>{{ $school->about }}</textarea>
  
                                @if ($errors->has('about'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('about') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="form-group{{ $errors->has('school_theme') ? ' has-error' : '' }}">
                            <label for="school_theme" class="col-md-4 control-label">Choose Theme</label>
  
                            <div class="col-md-6">
                                @include('layouts.master.theme-select')
  
                                @if ($errors->has('school_theme'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('school_theme') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}
                        
                        <div class="form-group">
                          <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-danger">Save</button>
                          </div>
                        </div>
                    </form>
                @endif
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
