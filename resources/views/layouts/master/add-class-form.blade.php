<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#addClassModal{{$school->id}}">+Add New Class</button>

<!-- Modal -->
<div class="modal fade" id="addClassModal{{$school->id}}" tabindex="-1" role="dialog" aria-labelledby="addClassModal{{$school->id}}Label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Add New Class</h4>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" action="{{url('school/add-class')}}" method="post">
          {{csrf_field()}}
          <div class="form-group">
            <label for="classNumber{{$school->id}}" class="col-sm-4 control-label">Class Number/Name</label>
            <div class="col-sm-8">
              <input type="text" name="class_number" class="form-control" id="classNumber{{$school->id}}" placeholder="Class Number/Name" required>
            </div>
          </div>
          {{--<div class="form-group">
            <label for="classRoomNumber{{$school->id}}" class="col-sm-4 control-label">Class Room Number</label>
            <div class="col-sm-8">
              <input type="number" class="form-control" id="classRoomNumber{{$school->id}}" placeholder="Class Room Number">
            </div>
          </div>
          --}}
          <div class="form-group">
            <label for="classRoomNumber{{$school->id}}" class="col-sm-4 control-label">Class Group (If Any)</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="group" id="classRoomNumber{{$school->id}}" placeholder="Science, Commerce, Arts, etc.">
              <span id="helpBlock" class="help-block">Leave Empty if this Class belongs to no Group</span>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-danger btn-sm">Submit</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
