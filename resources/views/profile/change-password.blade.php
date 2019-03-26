@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">
                    Change Password
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error-status'))
                        <div class="alert alert-danger">
                            {{ session('error-status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" action="{{url('user/config/change_password')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                            <label for="old_password" class="col-md-4 control-label">Old Password</label>

                            <div class="col-md-6">
                                <input id="old_password" type="text" class="form-control" name="old_password" value="{{ old('old_password') }}" required>

                                @if ($errors->has('old_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label for="new_password" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input id="new_password" type="text" class="form-control" name="new_password" value="{{ old('new_password') }}" required>

                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-danger">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
@endsection
