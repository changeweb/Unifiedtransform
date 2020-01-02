<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#addClassModal{{$school->id}}">+@lang('Add New House')</button>

<!-- Modal -->
<div class="modal fade" id="addClassModal{{$school->id}}" tabindex="-1" role="dialog" aria-labelledby="addClassModal{{$school->id}}Label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">@lang('Add New House')</h4>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" action="{{url('school/add-house')}}" method="post">
          {{csrf_field()}}
          {{-- <input type="hidden" value="{{$user->id}}" name="user_id"> --}}
          <div class="form-group">
            <label for="houseName{{$school->id}}" class="col-sm-4 control-label">@lang('House Name (Engligh)')</label>
            <div class="col-sm-8">
              <input type="text" name="house_name" class="form-control" id="houseName{{$school->id}}" placeholder="John Thomas">
            </div>
          </div>
          <div class="form-group">
            <label for="houseNameTon{{$school->id}}" class="col-sm-4 control-label">@lang('House Name (Tongan)')</label>
            <div class="col-sm-8">
              <input type="text" name="house_name_ton" class="form-control" id="houseNameTon{{$school->id}}" placeholder="Sione Tomasi">
            </div>
          </div>
          <div class="form-group">
            <label for="houseCode{{$school->id}}" class="col-sm-4 control-label">@lang('House Code')</label>
            <div class="col-sm-8">
              <input type="text" name="house_code" class="form-control" id="houseCode{{$school->id}}" placeholder="e.g. JT, SH">
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
