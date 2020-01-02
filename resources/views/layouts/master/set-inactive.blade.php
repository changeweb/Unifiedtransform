<a role="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#setInactive{{$user->id}}"><i class="material-icons">person_add_disabled</i> @lang('Set Inactive')</a>
<!-- MODAL -->
<div class="modal fade" id="setInactive{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="setInactive{{$user->id}}Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">@lang('Set Inactive Form')</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{url('/school/inactive')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$user->id}}" name="user_id">
                    <div class="form-group">
                        <label for="type" class="col-sm-4 control-label">@lang('Inactive Type')</label>
                        <div class="col-sm-8">
                            <select id="type" class="form-control" name="type">
                                @php
                                    $types = ['removed','withdrawn', 'suspended', 'expelled', 'leave']
                                @endphp
                                @foreach ($types as $type)
                                    <option value="{{$type}}">{{ucfirst($type)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-sm-4 control-label">@lang('Reason')</label>
                        <div class="col-sm-8">
                            <textarea id="notes" class="form-control" name="notes"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-sm">@lang('Submit')</button>
            </div> 
        </form>
        </div>
    </div>
</div>



