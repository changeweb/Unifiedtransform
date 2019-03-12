<div class="card text-white bg-info mb-3">
    <div class="card-header">Information</div>
    <div class="card-body">
      An Examination represents a Semester. All Courses of a Semester belong to an Examination. So, all Quiz, Class Test, Assignment, Attendance, Written, Practical, etc. in a Course are subjected to that specific Examination.
    </div>
</div>
{{$exams->links()}}
<div class="table-responsive">
  @foreach ($exams as $exam)
    <form id="form{{$exam->id}}" action="{{url('exams/activate-exam')}}" method="POST">
      {{csrf_field()}}
    </form>
  @endforeach
  <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Examination Name</th>
      <th scope="col">Notice Published</th>
      <th scope="col">Result Published</th>
      <th scope="col">Created At</th>
      <th scope="col">Set Active</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($exams as $exam)
    <tr>
      <th scope="row">{{($loop->index + 1)}}</th>
      <td scope="row">{{$exam->exam_name}}</td>
      <td scope="row">
        @if($exam->notice_published === 1)
          Yes
        @else
          @if($exam->result_published === 1)
            No
          @else
            <span class="label label-danger checkbox-inline">
              <input type="checkbox" name="notice_published" form="form{{$exam->id}}" /> Yes
            </span>
          @endif
        @endif
      </td>
      <td scope="row">
        @if($exam->result_published === 1)
          Yes
        @else
          <span class="label label-danger checkbox-inline">
            <input type="checkbox" name="result_published" form="form{{$exam->id}}" /> Yes
          </span>
        @endif
      </td>
      <td scope="row">{{Carbon\Carbon::parse($exam->created_at)->format('d/m/Y')}}</td>
      <td scope="row">
        <input type="hidden" name="exam_id" value="{{$exam->id}}" form="form{{$exam->id}}"/>
        @if($exam->active === 1)
          <span class="label label-success checkbox-inline">
            <input type="checkbox" name="active" form="form{{$exam->id}}" checked />
              Active
          </span>
        @else
          @if($exam->result_published === 1)
            Completed
          @else
            <span class="label label-danger checkbox-inline">
              <input type="checkbox" name="active" form="form{{$exam->id}}" />
              Not Active
            </span>
          @endif
        @endif
        @if($exam->result_published != 1)
          <input type="submit" class="btn btn-info btn-xs" style="margin-left: 1%;" value="Save" form="form{{$exam->id}}"/>
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{$exams->links()}}
