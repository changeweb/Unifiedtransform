<a class="btn btn-xs btn-info pull-right" data-toggle="collapse" href="#collapseForNewCourse{{$section->id}}" aria-expanded="false" aria-controls="collapseForNewCourse{{$section->id}}">+ @lang('Add New Course')</a>
  <div class="collapse" id="collapseForNewCourse{{$section->id}}" style="margin-top:1%;">
    <div class="panel panel-default">
      <div class="panel-body">
      <form class="form-horizontal" action="{{url('courses/store')}}" method="post">
          {{csrf_field()}}
          <input type="hidden" name="class_id" value="{{$class->id}}"/>
          <input type="hidden" name="section_id" value="{{$section->id}}"/>
          <div class="form-group">
            <label for="courseName{{$section->id}}" class="col-sm-2 control-label">@lang('Course Name')</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="courseName{{$section->id}}" name="course_name" placeholder="@lang('Course Name')">
            </div>
          </div>
          <div class="form-group">
            <label for="teacherDepartment{{$section->id}}" class="col-sm-2 control-label">@lang('Teacher Department')</label>
            <div class="col-sm-10">
              <select class="form-control" id="teacherDepartment{{$section->id}}" name="teacher_department">
                <option value="0" selected disabled>@lang('Select Department')</option>
                @if(count($departments) > 0)
                  @php
                    $departments_of_this_school = $departments->filter(function ($department) use ($school){
                      return $department->school_id == $school->id;
                    });
                  @endphp
                  @foreach ($departments_of_this_school as $d)
                    <option value="{{$d->department_name}}">{{$d->department_name}}</option>
                  @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="assignTeacher{{$section->id}}" class="col-sm-2 control-label">@lang('Assign Course Teacher')</label>
            <div class="col-sm-10">
              <select class="form-control" id="assignTeacher{{$section->id}}" name="teacher_id">
                <option value="0" selected disabled>@lang('Select Department First')</option>
                @if(count($teachers) > 0)
                  @php
                    $teachers_of_this_school = $teachers->filter(function ($teacher) use ($school){
                      return $teacher->school_id == $school->id;
                    });
                  @endphp
                  @foreach($teachers_of_this_school as $teacher)
                    <option value="{{$teacher->id}}" data-department="{{$teacher->department_name}}">{{$teacher->name}} {{$teacher->department_name}}</option>
                  @endforeach
                @endif
              </select>
            </div>
          </div>
        <div class="form-group">
          <label for="course_type{{$section->id}}" class="col-sm-2 control-label">@lang('Course Type')</label>
          <div class="col-sm-10">
            <select class="form-control" id="course_type{{$section->id}}" name="course_type">
              <option value="core">@lang('Core')</option>
              <option value="elective">@lang('Elective')</option>
              <option value="optional">@lang('Optional')</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="courseTime{{$section->id}}" class="col-sm-2 control-label">@lang('Course Time')</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="courseTime{{$section->id}}" name="course_time" placeholder="@lang('Course Time')">
            <span id="helpBlock" class="help-block">@lang('Example: 12:50PM-01:40PM Sunday')</span>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-danger">@lang('Submit')</button>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
<script>
  $('#teacherDepartment{{$section->id}}').click(function () {
    $("#assignTeacher{{$section->id}} option").hide();
    $("#assignTeacher{{$section->id}} option[data-department="+$(this).val()+"]").show();
  });
</script>
