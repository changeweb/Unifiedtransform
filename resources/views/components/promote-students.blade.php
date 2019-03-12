<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">
<div class="table-responsive">
<form action="{{url('school/promote-students')}}" method="post">
  {{ csrf_field() }}
<input type="hidden" name="section_id" value="{{$section_id}}">
<table class="table table-bordered table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Code</th>
      <th scope="col">Name</th>
      <th scope="col">From Session</th>
      <th scope="col">To Session</th>
      <th scope="col">From Section</th>
      <th scope="col">To Section</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($students as $key=>$student)
    <tr>
      <th scope="row">{{ ($loop->index + 1) }}</th>
      <td><small>{{$student->student_code}}</small></td>
      <td><small><a href="{{url('student/'.$student->student_code)}}">{{$student->name}}</a></small></td>
      <td><small>{{$student->studentInfo['session']}}</small></td>
      <td><input class="form-control datepicker" name="to_session[]" value="{{date('Y', strtotime('+1 year'))}}"></td>
      <td style="text-align: center;">
        <small>Class: {{$student->section->class->class_number}} - Section: {{$student->section->section_number}}</small>
      </td>
      <td>
        <select id="to_section" class="form-control" name="to_section[]">
          @foreach($classes as $class)
            @foreach($class->sections as $section)
              <option value="{{$section->id}}">
                Class: {{$class->class_number}} - 
                Section: {{$section->section_number}}
              </option>
            @endforeach
          @endforeach
        </select>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<div style="text-align:center;">
  <input type="submit" class="btn btn-primary" value="Submit">
</div>
</form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
  $(function(){
    $('.datepicker').datepicker({
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years"
    });
  })
</script>
