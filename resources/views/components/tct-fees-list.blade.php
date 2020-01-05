@component('components.fee-type-form', [
    'buttonTitle' => 'Add Fee',
    'modal_name' => 'myModal',
    'title' => 'New Fee',
    'put_method' => '',
    'url' => url('fees/tct_create'),
])
    @slot('buttonType')
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal"><i class="material-icons">add</i> 
    @endslot
    @slot('form_content')
        <div class="form-group">
            <label for="name" class="col-sm-4 control-label">@lang('Name')</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="name" name="name">
            </div>
        </div>
        <div class="form-group">
            <label for="session" class="col-sm-4 control-label">@lang('Session')</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="session" name="session" value="{{now()->year}}">
            </div>
        </div>
        <div class="form-group">
            <label for="type" class="col-sm-4 control-label">@lang('Fee Type')</label>
            <div class="col-sm-8">
                <select id="type" class="form-control" name="type">
                    @php
                        $types = \App\FeeType::where('active', 1)->get();
                    @endphp
                    @foreach ($types as $type)
                        <option value="{{$type->id}}">{{ucfirst($type->name)}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="channel" class="col-sm-4 control-label">@lang('Fee Channel')</label>
            <div class="col-sm-8">
                <select id="channel" class="form-control" name="channel">
                    @php
                        $channels = \App\FeeChannel::where('active', 1)->where('session', now()->year)->get();
                    @endphp
                    @foreach ($channels as $channel)
                        <option value="{{$channel->id}}">{{ucfirst($channel->name)}}</option>
                    @endforeach
                </select>
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
            <label for="amount" class="col-sm-4 control-label">@lang('Amount')</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="amount" name="amount" placeholder="0.00">
            </div>
        </div>
        {{-- <div class="form-group">
            <label for="notes" class="col-sm-4 control-label">@lang('Commentary')</label>
            <div class="col-sm-8">
                <textarea id="notes" class="form-control" name="notes"></textarea>
            </div>
        </div> --}}
    @endslot
@endcomponent
<hr>
          
<!-- Removed table-data-div to resolve form alignment issues -->
<div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Name</th>
          <th class="text-center">Channel</th>
          <th class="text-center">Type</th>
          <th class="text-center">Active</th>
          <th class="text-center">Session</th>
          <th class="text-center">Amount</th>
          <th class="text-center">Edit</th>
        </tr>
      </thead>
      <tbody>
        @foreach($fees as $fee)
        <tr>
          <td class="text-center">{{($loop->index + 1)}}</td>
          <td class="text-center">{{$fee->fee_name}}</td>
          <td class="text-center">{{$fee->fee_channel->name}}</td>
          <td class="text-center">{{$fee->fee_type->name}}</td>
          <td class="text-center">{{($fee->active)?'Yes':'No'}}</td>
          <td class="text-center">{{$fee->session}}</td>
          <td class="text-center">{{$fee->amount}}</td>
          <td class="text-center">
            @component('components.fee-type-form', [
                'buttonTitle' => 'Edit Fee',
                'modal_name' => 'myModal'.$fee->id,
                'title' => 'Edit Fee',
                'put_method' => method_field('PUT'),
                'url' => url('fees/tct_create/'.$fee->id),
            ])
                @slot('buttonType')
                    <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal{{$fee->id}}"><i class="material-icons">edit</i> 
                @endslot
                @slot('form_content')
                    <div class="row form-group">
                        <label for="name" class="col-sm-4 control-label">@lang('Name')</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" value="{{$fee->fee_name}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="session" class="col-sm-4 control-label">@lang('Session')</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="session" name="session" value="{{$fee->session}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="type" class="col-sm-4 control-label">@lang('Fee Type')</label>
                        <div class="col-sm-8">
                            <select id="type" class="form-control" name="type">
                                @php
                                    $types = \App\FeeType::where('active', 1)->get();
                                @endphp
                                @foreach ($types as $type)
                                    <option value="{{$type->id}}" {{($type->id == $fee->fee_type_id)?"selected='selected'":''}}>{{ucfirst($type->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="channel" class="col-sm-4 control-label">@lang('Fee Channel')</label>
                        <div class="col-sm-8">
                            <select id="channel" class="form-control" name="channel">
                                @php
                                    $channels = \App\FeeChannel::where('active', 1)->where('session', now()->year)->get();
                                @endphp
                                @foreach ($channels as $channel)
                                    <option value="{{$channel->id}}" {{($channel->id == $fee->fee_channel_id)?"selected='selected'":''}}>{{ucfirst($channel->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="active" class="col-sm-4 control-label">@lang('Active')</label>
                        <div class="col-sm-8">
                            <select id="active" class="form-control" name="active">
                                <option value="1" {{($fee->active == 1)?'selected="selected"':''}}>Active</option>
                                <option value="0" {{($fee->active == 0)?'selected="selected"':''}}>Not Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="amount" class="col-sm-4 control-label">@lang('Amount')</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="amount" name="amount" value="{{$fee->amount}}">
                        </div>
                    </div>
                @endslot
            @endcomponent
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  