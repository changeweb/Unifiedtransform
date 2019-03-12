<script>
  $(document).ready(function () {
    $('.nav-item.active').removeClass('active');
    $('a[href="' + window.location.href + '"]').closest('li').closest('ul').closest('li').addClass('active');
    $('a[href="' + window.location.href + '"]').closest('li').addClass('active');
  });
</script>
<style>
  .nav-item.active {
    background-color: #fce8e6;
    font-weight: bold;
  }

  .nav-item.active a {
    color: #d93025;
  }

  .nav-link-text {
    padding-left: 10%;
  }

  #side-navbar ul>li>a {
    padding: 8px 15px;
  }
</style>
{{--@if(Auth::user()->role != 'master')
<ul class="nav flex-column">
  <li class="nav-item">
    <a class="nav-link" href="{{url('user/'.Auth::user()->student_code)}}"><i class="material-icons">face</i> <span
        class="nav-link-text">Profile</span></a>
  </li>
</ul>
@endif--}}
<ul class="nav flex-column">
  <li class="nav-item active">
    <a class="nav-link" href="{{ url('home') }}"><i class="material-icons">dashboard</i> <span class="nav-link-text">Dashboard</span></a>
  </li>
  @if(Auth::user()->role == 'admin')
  <li class="nav-item dropdown">
    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
        class="material-icons">date_range</i> <span class="nav-link-text">Attendance</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
    <ul class="dropdown-menu" style="width: 100%;">
      <li class="nav-item">
        <a class="dropdown-item" href="#"><i class="material-icons">contacts</i> <span class="nav-link-text">Teacher
            Attendance</span></a>
      </li>
      <li class="nav-item">
        <a class="dropdown-item" href="{{url('school/sections?att=1')}}"><i class="material-icons">contacts</i> <span
            class="nav-link-text">Student Attendance</span></a>
      </li>
      <li class="nav-item">
        <a class="dropdown-item" href="#"><i class="material-icons">account_balance_wallet</i> <span class="nav-link-text">Staff
            Attendance</span></a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('school/sections?course=1') }}"><i class="material-icons">class</i> <span class="nav-link-text">Classes
        &amp; Sections</span></a>
  </li>
  @endif

  {{-- <li class="nav-item dropdown">
    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
        class="material-icons">contacts</i> <span class="nav-link-text">Users Lists</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
    <ul class="dropdown-menu" style="width: 100%;">
      @if(Auth::user()->role != 'student')
      <li class="nav-item">
        <a class="dropdown-item" href="{{url('users/'.Auth::user()->school->code.'/1/0')}}"><i class="material-icons">contacts</i>
          <span class="nav-link-text">Student List</span></a>
      </li>
      <li class="nav-item">
        <a class="dropdown-item" href="{{url('users/'.Auth::user()->school->code.'/0/1')}}"><i class="material-icons">contacts</i>
          <span class="nav-link-text">Teacher List</span></a>
      </li>
      @endif
      @if(Auth::user()->role == 'admin')
      <li class="nav-item">
        <a class="dropdown-item" href="{{url('users/'.Auth::user()->school->code.'/accountant')}}"><i class="material-icons">account_balance_wallet</i>
          <span class="nav-link-text">Accountant List</span></a>
      </li>
      <li class="nav-item">
        <a class="dropdown-item" href="{{url('users/'.Auth::user()->school->code.'/librarian')}}"><i class="material-icons">local_library</i>
          <span class="nav-link-text">Librarian List</span></a>
      </li>
      @endif
    </ul>
  </li> --}}
  @if(Auth::user()->role != 'student')
  <li class="nav-item">
    <a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/1/0')}}"><i class="material-icons">contacts</i>
      <span class="nav-link-text">Students</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/0/1')}}"><i class="material-icons">contacts</i>
      <span class="nav-link-text">Teachers</span></a>
  </li>
  @endif
  @if(Auth::user()->role == 'admin')
  <li class="nav-item dropdown">
    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
        class="material-icons">line_style</i> <span class="nav-link-text">Exams</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
    <ul class="dropdown-menu" style="width: 100%;">
      <!-- Dropdown menu links -->
      <li>
        <a class="dropdown-item" href="{{ url('exams/create') }}"><i class="material-icons">note_add</i> <span class="nav-link-text">Add
            Examination</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('exams/active') }}"><i class="material-icons">developer_board</i> <span
            class="nav-link-text">Active Exams</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('exams') }}"><i class="material-icons">settings</i> <span class="nav-link-text">Manage
            Examinations</span></a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('grades/all-exams-grade') }}"><i class="material-icons">assignment</i> <span class="nav-link-text">Grades</span></a>
  </li>
  <li class="nav-item" style="border-bottom: 1px solid #dbd8d8;"></li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('academic/routine') }}"><i class="material-icons">calendar_today</i> <span class="nav-link-text">Class
        Routine</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('academic/syllabus') }}"><i class="material-icons">vertical_split</i> <span class="nav-link-text">Syllabus</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('academic/notice') }}"><i class="material-icons">announcement</i> <span class="nav-link-text">Notice</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('academic/event') }}"><i class="material-icons">event</i> <span class="nav-link-text">Event</span></a>
  </li>
  <li class="nav-item" style="border-bottom: 1px solid #dbd8d8;"></li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('create-school') }}"><i class="material-icons">settings</i> <span class="nav-link-text">Academic
        Settings</span></a>
  </li>
  <li class="nav-item dropdown">
    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
        class="material-icons">chrome_reader_mode</i> <span class="nav-link-text">Manage GPA</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
    <ul class="dropdown-menu" style="width: 100%;">
      <!-- Dropdown menu links -->
      <li>
        <a class="dropdown-item" href="{{ url('gpa/all-gpa') }}"><i class="material-icons">developer_board</i> <span
            class="nav-link-text">All GPA</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('gpa/create-gpa') }}"><i class="material-icons">note_add</i> <span class="nav-link-text">Add
            New GPA</span></a>
      </li>
    </ul>
  </li>
  @endif
  @if(Auth::user()->role == 'admin' || Auth::user()->role == 'accountant')
  <li class="nav-item dropdown">
    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
        class="material-icons">monetization_on</i> <span class="nav-link-text">Fees Generator</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
    <ul class="dropdown-menu" style="width: 100%;">
      <!-- Dropdown menu links -->
      <li>
        <a class="dropdown-item" href="{{ url('fees/all') }}"><i class="material-icons">developer_board</i> <span class="nav-link-text">Generate
            Form</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('fees/create') }}"><i class="material-icons">note_add</i> <span class="nav-link-text">Add
            Fee Field</span></a>
      </li>
    </ul>
  </li>
  @endif
  {{--@if(Auth::user()->role == 'admin')
  <li class="nav-item dropdown">
    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
        class="material-icons">cloud_upload</i> <span class="nav-link-text">Manage Uploads</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
    <ul class="dropdown-menu" style="width: 100%;">
      <!-- Dropdown menu links -->
      <li>
        <a class="dropdown-item" href="{{ url('academic/notice') }}"><i class="material-icons">developer_board</i>
          <span class="nav-link-text">Upload Notice</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('academic/event') }}"><i class="material-icons">developer_board</i> <span
            class="nav-link-text">Upload Event</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('academic/routine') }}"><i class="material-icons">developer_board</i>
          <span class="nav-link-text">Upload Routine</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('academic/syllabus') }}"><i class="material-icons">developer_board</i>
          <span class="nav-link-text">Upload Syllabus</span></a>
      </li>
    </ul>
  </li>
  @endif--}}
  @if(Auth::user()->role == 'admin' || Auth::user()->role == 'accountant')
  <li class="nav-item dropdown">
    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
        class="material-icons">account_balance_wallet</i> <span class="nav-link-text">Manage Accounts</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
    <ul class="dropdown-menu" style="width: 100%;">
      <!-- Dropdown menu links -->
      <li>
        <a class="dropdown-item" href="{{ url('accounts/sectors') }}"><i class="material-icons">developer_board</i>
          <span class="nav-link-text">Account Sectors</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('accounts/expense') }}"><i class="material-icons">note_add</i> <span
            class="nav-link-text">Add New Expense</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('accounts/expense-list') }}"><i class="material-icons">developer_board</i>
          <span class="nav-link-text">Expense List</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('accounts/income') }}"><i class="material-icons">note_add</i> <span class="nav-link-text">Add
            New Income</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('accounts/income-list') }}"><i class="material-icons">developer_board</i>
          <span class="nav-link-text">Income List</span></a>
      </li>
    </ul>
  </li>
  @endif
  @if(Auth::user()->role == 'student')
  <li class="nav-item">
    <a class="nav-link active" href="{{ url('attendances/0/'.Auth::user()->id.'/0') }}"><i class="material-icons">date_range</i>
      <span class="nav-link-text">My Attendance</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('courses/0/'.Auth::user()->section_id) }}"><i class="material-icons">subject</i>
      <span class="nav-link-text">My Courses</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ url('grades/'.Auth::user()->id) }}"><i class="material-icons">bubble_chart</i> <span
        class="nav-link-text">My Grade</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#"><i class="material-icons">payment</i> <span class="nav-link-text">Payment History</span></a>
  </li>
  @endif
  {{--<div style="text-align:center;">Student</div>--}}
  {{--<div style="text-align:center;">Teacher</div>--}}
  @if(Auth::user()->role == 'admin' || Auth::user()->role == 'librarian')
  <li class="nav-item dropdown">
    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
        class="material-icons">local_library</i> <span class="nav-link-text">Manage Library</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
    <ul class="dropdown-menu" style="width: 100%;">
      <!-- Dropdown menu links -->
      <li>
        <a class="dropdown-item" href="{{ url('library/all-books') }}"><i class="material-icons">developer_board</i>
          <span class="nav-link-text">All Books</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('library/issued-books') }}"><i class="material-icons">developer_board</i>
          <span class="nav-link-text">All Issued Books</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('library/issue-books') }}"><i class="material-icons">receipt</i> <span
            class="nav-link-text">Issue Book</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('library/add-new-book') }}"><i class="material-icons">note_add</i> <span
            class="nav-link-text">Add New Book</span></a>
      </li>
    </ul>
  </li>
  @endif
  @if(Auth::user()->role == 'teacher')
  <li class="nav-item">
    <a class="nav-link" href="{{ url('courses/'.Auth::user()->id.'/0') }}"><i class="material-icons">import_contacts</i>
      <span class="nav-link-text">My Courses</span></a>
  </li>
  @endif
</ul>