{{$users->links()}}
<div class="table-responsive">
<table class="table table-bordered table-data-div table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      @if(Auth::user()->role == 'admin')
        @if (!Session::has('section-attendance'))
        <th scope="col">Action</th>
        @endif
      @endif
      <th scope="col">Code</th>
      <th scope="col">Full Name</th>
      @foreach ($users as $user)
        @if($user->role == 'student')
          @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
            <th scope="col">Attendance</th>
            {{--@if (!Session::has('section-attendance'))
            <th scope="col">Marks</th>
            @endif --}}
          @endif
            @if (!Session::has('section-attendance'))
            <th scope="col">Session</th>
            <th scope="col">Version</th>
            <th scope="col">Class</th>
            <th scope="col">Section</th>
            <th scope="col">Father</th>
            <th scope="col">Mother</th>
            @endif
        @elseif($user->role == 'teacher')
          @if (!Session::has('section-attendance'))
          <th scope="col">Email</th>
          @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
            <th scope="col">Courses</th>
          @endif
          @endif
        @elseif($user->role == 'accountant' || $user->role == 'librarian')
          @if (!Session::has('section-attendance'))
          <th scope="col">Email</th>
          @endif
        @endif
        @break($loop->first)
      @endforeach
      @if (!Session::has('section-attendance'))
      <th scope="col">Gender</th>
      <th scope="col">Blood</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      @endif
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key=>$user)
    <tr>
      <th scope="row">{{ ($current_page-1) * $per_page + $key + 1 }}</th>
      @if(Auth::user()->role == 'admin')
        @if (!Session::has('section-attendance'))
        <td>
          <a class="btn btn-xs btn-danger" href="{{url('edit/user/'.$user->id)}}">Edit</a>
        </td>
        @endif
      @endif
      <td><small>{{$user->student_code}}</small></td>
      <td>
        <small>
          @if(!empty($user->pic_path))
            <img src="{{asset('01-progress.gif')}}" data-src="{{url($user->pic_path)}}" style="border-radius: 50%;" width="25px" height="25px">
          @else
            @if(strtolower($user->gender) == 'male')
              <img src="{{asset('01-progress.gif')}}" data-src="https://png.icons8.com/dusk/50/000000/user.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
            @else
              <img src="{{asset('01-progress.gif')}}" data-src="https://png.icons8.com/dusk/50/000000/user-female.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
            @endif
          @endif
          <a href="{{url('user/'.$user->student_code)}}">
            {{$user->name}}</a>
          </small></td>
      @if($user->role == 'student')
        @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
          <td><small><a class="btn btn-xs btn-info" role="button" href="{{url('attendances/0/'.$user->id.'/0')}}">View Attendance</a></small></td>
          {{--@if (!Session::has('section-attendance'))
          <td><small><a class="btn btn-xs btn-success" role="button" href="{{url('grades/'.$user->id)}}">View Marks</a></small></td>
          @endif --}}
        @endif
        @if (!Session::has('section-attendance'))
        <td><small>{{$user->studentInfo['session']}}</small></td>
        <td><small>{{ucfirst($user->studentInfo['version'])}}</small></td>
        <td><small>{{$user->section->class->class_number}} {{!empty($user->group)? '- '.$user->group:''}}</small></td>
        <td style="white-space: nowrap;"><small>{{$user->section->section_number}}
          {{-- @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
            - <a class="btn btn-xs btn-primary" role="button" href="{{url('courses/0/'.$user->section->id)}}">All Courses</a>
          @endif --}}
          </small>
        </td>
        <td><small>{{$user->studentInfo['father_name']}}</small></td>
        <td><small>{{$user->studentInfo['mother_name']}}</small></td>
        @endif
      @elseif($user->role == 'teacher')
        @if (!Session::has('section-attendance'))
        <td>
          <small>{{$user->email}}</small>
        </td>
        @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
        <td style="white-space: nowrap;">
          <small>
            <a href="{{url('courses/'.$user->id.'/0')}}">All Courses</a>
          </small>
        </td>
        @endif
        @endif
      @elseif($user->role == 'accountant' || $user->role == 'librarian')
        @if (!Session::has('section-attendance'))
        <td>
          <small>{{$user->email}}</small>
        </td>
        @endif
      @endif
      @if (!Session::has('section-attendance'))
      <td><small>{{ucfirst($user->gender)}}</small></td>
      <td><small>{{$user->blood_group}}</small></td>
      <td><small>{{$user->phone_number}}</small></td>
      <td><small>{{$user->address}}</small></td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{$users->links()}}
