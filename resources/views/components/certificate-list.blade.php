<div class="table-responsive">
  <table class="table table-bordered table-data-div table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">@lang('File Name')</th>
        <th scope="col">Received Date</th>
      </tr>
    </thead>
    <tbody>
    @isset($files)
      @foreach($files as $file)
      <tr>
        <td>{{($loop->index + 1)}}</td>
        <td><a href="{{url($file->file_path)}}" target="_blank">{{$file->title}}</a></td>
        <td>{{$file->created_at->format('M d Y')}}</td>
      </tr>
      @endforeach
    @endisset
    </tbody>
  </table>
</div>
