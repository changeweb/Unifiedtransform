<button class="btn btn-primary btn-block" id="create-section-btn-class-{{$class->id}}">+ @lang('Create a New Section')</button>
<br/>
<div class="panel panel-default" id="create-section-btn-panel-class-{{$class->id}}" style="display:none;">
  <div class="panel-body">
  <form class="form-horizontal" action="{{url('school/add-section')}}" method="post">
      {{csrf_field()}}
      <input type="hidden" name="class_id" value="{{$class->id}}"/>
      <div class="form-group">
        <label for="section_number{{$class->class_number}}" class="col-sm-2 control-label">@lang('Section Name')</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="section_number{{$class->class_number}}" name="section_number" placeholder="@lang('A, B, C, etc..')">
        </div>
      </div>
      <div class="form-group">
        <label for="room_number{{$class->class_number}}" class="col-sm-2 control-label">@lang('Room Number')</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="room_number{{$class->class_number}}" name="room_number" placeholder="@lang('Room Number')">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-danger btn-sm">@lang('Submit')</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  $("#create-section-btn-class-{{$class->id}}").click(function(){
    $("#create-section-btn-panel-class-{{$class->id}}").toggle();
  });
</script>
