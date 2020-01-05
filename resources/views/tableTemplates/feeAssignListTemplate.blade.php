{{-- <table class="table">
    <thead>
        @foreach ($types as $type)
            <th class="text-center">{{$type->fee_type->name}}</th>
        @endforeach
    </thead>
    <tbody>
        @foreach ($types as $type)
            <td class="text-center">
                <input type="checkbox" class="toggle_one" checked name="type{{$type->fee_type->id}}" value='' id="type{{$type->fee_type->id}}">
                <br>{{$type->amount}}
            </td>
        @endforeach
    </tbody>
</table> --}}
<div class="form-group">
    <label for="session" class="col-sm-4 control-label">@lang('Session')</label>
    <div class="col-sm-4">
        <input id="session" class="form-control" name="session" value="{{now()->year}}">
    </div>
</div>

@foreach($types as $type)
<div class="row form-group">
    <label for="type{{$type->fee_type->id}}" class="col-sm-4 control-label">{{$type->fee_type->name}}</label>
    <div class="col-sm-4">
        <select id="type{{$type->fee_type->id}}" class="form-control" name="type[{{$type->fee_type->id}}]">
            <option value="1">Assign</option>
            <option value="0">No</option>
        </select>
    </div>
</div>
@endforeach
