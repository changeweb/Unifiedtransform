@extends('layouts.app')

@section('title', __('Fee Channel'))

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>

        <div class="col-md-10" id="main-container">
            <br>
            <h4>@lang('All Fee Channels')</h4>
            <br>
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="text-white bg-danger">{{$error}}</div>
                {{-- <span class="error">{{ $error}}</span> --}}
            @endforeach
            <br>
        @endif
            <!-- Componeent holds modal details -->
            @component('components.fee-type-form', [
                'buttonTitle' => 'Add Fee Channel',
                'modal_name' => 'myModal',
                'title' => 'New Fee Channel',
                'put_method' => '',
                'url' => url('fees/fee_channel'),
            ])
                @slot('buttonType')
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal"><i class="material-icons">add</i> 
                @endslot
                @slot('form_content')
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">@lang('Name')</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" placeholder="e.g term1, term2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="session" class="col-sm-4 control-label">@lang('session')</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="session" name="session" value="{{now()->year}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="active" class="col-sm-4 control-label">@lang('Active')</label>
                        <div class="col-sm-8">
                            <select id="active" class="form-control" name="active">
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-sm-4 control-label">@lang('Commentary')</label>
                        <div class="col-sm-8">
                            <textarea id="notes" class="form-control" name="notes"></textarea>
                        </div>
                    </div>
                @endslot
            @endcomponent
            <hr>
          
            <div class="panel panel-default">
                @if($fee_channels->first())
                    <table id="fee_channel" class='table'>
                        <thead>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Active</th>
                            <th class="text-center">Session</th>
                            <th class="text-center">Notes</th>
                            {{-- <th class="text-center">Number of Channels</th> --}}
                            <th class="text-center">Edit</th>
                        </thead>
                        <tbody>
                            @foreach($fee_channels as $channel)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$channel->name}}</td>
                                    <td class="text-center">{{($channel->active)?'Active':'Inactive'}}</td>
                                    <td class="text-center">{{$channel->session}}</td>
                                    <td class="text-center">{{$channel->notes}}</td>
                                    {{-- <td class="text-center"></td> --}}
                                    <td class="text-center">
                                        @component('components.fee-type-form', [
                                            'buttonTitle' => 'Edit Fee Channel',
                                            'modal_name' => 'myModal'.$channel->id,
                                            'title' => 'Edit Fee Channel',
                                            'put_method' => method_field('PUT'),
                                            'url' => url('fees/fee_channel/'.$channel->id),
                                        ])
                                            @slot('buttonType')
                                                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal{{$channel->id}}"><i class="material-icons">edit</i> 
                                            @endslot
                                            @slot('form_content')
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-4 control-label">@lang('Name')</label>
                                                    <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="name" name="name" value="{{$channel->name}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="session" class="col-sm-4 control-label">@lang('Session')</label>
                                                    <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="session" name="session" value="{{$channel->session}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="active" class="col-sm-4 control-label">@lang('Active')</label>
                                                    <div class="col-sm-8">
                                                        <select id="active" class="form-control" name="active">
                                                            <option value="1" {{($channel->active == 1)?'selected="selected"':''}}>Active</option>
                                                            <option value="0" {{($channel->active == 0)?'selected="selected"':''}}>Not Active</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="notes" class="col-sm-4 control-label">@lang('Commentary')</label>
                                                    <div class="col-sm-8">
                                                        <textarea id="notes" class="form-control" name="notes">{{$channel->notes}}</textarea>
                                                    </div>
                                                </div>
                                            @endslot
                                        @endcomponent
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
