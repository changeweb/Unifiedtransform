<div class="table-responsive">
  <table class="table table-bordered table-data-div table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">@lang('File Name')</th>
        @if($upload_type == 'syllabus' && $parent == 'class')
          <th scope="col">@lang('Class')</th>
        @elseif($upload_type == 'routine' && $parent == 'section')
          <th scope="col">@lang('section')</th>
        @elseif($upload_type == 'certificate')
          <th scope="col">Certificates</th>
        @endif
        <th scope="col">@lang('Is Active')</th>
        <th scope="col">@lang('Action')</th>
      </tr>
    </thead>
    <tbody>
      @foreach($files as $file)
      <tr>
        <td>{{($loop->index + 1)}}</td>
        <td><a href="{{url($file->file_path)}}" target="_blank">{{$file->title}}</a></td>
        @if($upload_type == 'syllabus' && $parent == 'class')
          <td>{{$file->myclass->class_number}}</td>
        @elseif($upload_type == 'routine' && $parent == 'section')
          <td>{{$file->section->section_number}}</td>
        @elseif($upload_type == 'certificate')
          @isset($file->student->name)
            <td>{{$file->student->name}}</td>
          @endisset
          @empty($file->student)
            <td>Student Code: <span style="color: #d93025;">{{$file->given_to}}</span> does not exist</td>
          @endempty
        @endif
        <td>{{($file->active === 1)?'Yes':'No'}}</td>
        <td>
          <a href="{{url('academic/remove/'.$upload_type)}}" onclick="event.preventDefault();
            document.getElementById('remove-file-'+{{$file->id}}).submit();" class="btn btn-danger btn-sm" role="button"><i class="material-icons">delete</i> @lang('Remove')</a>

          <form id="remove-file-{{$file->id}}" action="{{url('academic/remove/'.$upload_type)}}" method="POST" style="display: none;">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$file->id}}">
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
