@extends('layouts.app')

@if(count(array($user)) > 0)
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
              @if(count(array($user)) > 0)
                <div class="panel-body">
                    @php $userSer = $user; @endphp
                    @inject('userSer', 'App\Services\User\UserService')
                    @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="bg-danger text-white">{{$error}}</div>
                    @endforeach
                    <br>
                    @endif


                    <div class="row">
                        <div class="col-md-12 container" id="main-container">
                            <!-- STUDENT SUMMARY -->
                            <div class="container">
                                    @component('components.tct-student-summary',['user'=>$user])
                                    @endcomponent 
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <form class="form-horizontal" action="{{url('tct_edit_administration')}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$user->id}}" name="user_id">
                                <input id='year' type="hidden" value="{{$session}}" name="session">
                                <div class="row form-group">
                                    <label for="channel" class="col-sm-4 control-label">@lang('Fee Channel')</label>
                                    <div class="col-sm-8">
                                        <select id="channel" class="form-control" name="channel">
                                            @php
                                                $channels[$session] = \App\FeeChannel::where('session',$session)->get();
                                            @endphp
                                                <option value="">Select Channel</option>
                                            @foreach ($channels[$session] as $channel)
                                                <option value="{{$channel->id}}">{{ucfirst($channel->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- {{$channels[$session]}} --}}
                                </div>
                                <hr>    
                                <div class="row" id="feeToAssign"></div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger btn-sm">@lang('Submit')</button>
                                </div> 
                            </form>
                        </div>
                    </div>
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
  