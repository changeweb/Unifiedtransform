<a role="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#reinstate{{$user->id}}"><i class="material-icons">redo</i> @lang('Reinstate')</a>
<!-- MODAL -->
<div class="modal fade" id="reinstate{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="reinstate{{$user->id}}Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">@lang('Reinstate Form')</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{url('/school/reinstate')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$user->id}}" name="user_id">
                    <input type="hidden" value="{{$userSer->getInactiveRequest($user)->id}}" name="inactive_id">
                    {{-- <div class="form-group">
                        <label for="type" class="col-sm-4 control-label">@lang('Inactive Details')</label>
                        <div class="col-sm-8">
                            <p>{{Carbon\Carbon::parse($userSer->getInactiveRequest($user)->created_at)->format('d/m/Y')}}  - {{ucfirst($userSer->getInactiveRequest($user)->type)}} </p>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label for="notes" class="col-sm-4 control-label">@lang('Approval Conditions')</label>
                        <div class="col-sm-8">
                            <textarea id="notes" class="form-control" name="notes"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="approval" class="col-sm-4 control-label">@lang('Confirm reinstate')</label>
                        <div class="col-sm-8">
                            <select id="approval" class="form-control" name="approval">
                                <option value="0">Not Approved</option>
                                <option value="1">Approved</option>
                            </select>
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
