<a role="button" class="btn btn-danger btn-xs" href="" data-toggle="modal" data-target="#editSectionModal{{$house->id}}"><i class="material-icons">edit</i> @lang('Edit House')</a>
<!-- MODAL -->
<div class="modal fade" id="editSectionModal{{$house->id}}" tabindex="-1" role="dialog" aria-labelledby="editSectionModal{{$house->id}}Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">@lang('Edit House Details')</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{url('school/edit-tct-house/'.$house->id)}}" method="post">
                    {{csrf_field()}}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="houseName{{$school->id}}" class="col-sm-4 control-label">@lang('House Name (Engligh)')</label>
                        <div class="col-sm-8">
                          <input type="text" name="house_name" class="form-control" id="houseName{{$school->id}}" value="{{$house->house_name}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="houseNameTon{{$school->id}}" class="col-sm-4 control-label">@lang('House Name (Tongan)')</label>
                        <div class="col-sm-8">
                          <input type="text" name="house_name_ton" class="form-control" id="houseNameTon{{$school->id}}" value="{{$house->house_name_ton}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="houseCode{{$school->id}}" class="col-sm-4 control-label">@lang('House Code')</label>
                        <div class="col-sm-8">
                          <input type="text" name="house_code" class="form-control" id="houseCode{{$school->id}}" value="{{$house->house_abbrv}}">
                        </div>
                      </div>
                    <div class="form-group">
                        <label for="active{{$house->id}}" class="col-sm-4 control-label">@lang('Set as Active')</label>
                        <div class="col-sm-8">
                            <select id="house_active" class="form-control" name="house_active">
                                <option value="1" {{($house->active == 1)? 'selected="selected"' : ''}}>Active</option>
                                <option value="0" {{($house->active == 0)? 'selected="selected"' : ''}}>Inactive</option>
                            </select>
                            {{-- <span id="helpBlock" class="help-block">@lang('Please move students first before deactivating house')</span> --}}
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
