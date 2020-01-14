@if($types->first())
    <div class="form-group">
        <label for="session" class="col-sm-4 control-label">@lang('Session')</label>
        <div class="col-sm-4">
            <input id="session" class="form-control" name="session" value="{{$session}}">
        </div>
    </div>
    @foreach($types as $type)
        <div class="row form-group">
            <label for="type{{$type->fee_type->id}}" class="col-sm-4 control-label">{{$type->fee_type->name}}</label>
            <div class="col-sm-4">
                <select id="type{{$type->fee_type->id}}" class="form-control" name="type[{{$type->fee_type->id}}]">
                    <option value="1">Assign</option>
                    <option value="0" @if($type->fee_type->name == "Late Registration") selected="selected" @endif>No</option>
                </select>
            </div>
        </div>
    @endforeach
@else
    <div class="row">
        Please assign fees to selected channel
    </div>
@endif
