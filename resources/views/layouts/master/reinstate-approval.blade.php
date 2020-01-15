<a role="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#reinstateApproval{{$user->id}}"><i class="material-icons">done_outline</i> @lang('Approval')</a>
<!-- MODAL -->
<div class="modal fade" id="reinstateApproval{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="reinstateApproval{{$user->id}}Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">@lang('Reinstate Form')</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{url('/school/reinstate_approval')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$user->id}}" name="user_id">
                    <input type="hidden" value="{{$userSer->getInactiveRequest($user)->id}}" name="inactive_id">
                    <input type="hidden" value="{{$userSer->getReinstateRequest($user)->id}}" name="reinstate_id">
                    <div class="form-group">
                        <label for="approval" class="col-sm-4 control-label">@lang('Confirm approval')</label>
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
