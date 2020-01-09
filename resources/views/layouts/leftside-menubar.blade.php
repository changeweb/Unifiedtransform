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
  <ul class="nav flex-column">
    <li class="nav-item active">
      <a class="nav-link" href="{{ url('home') }}"><i class="material-icons">dashboard</i> <span class="nav-link-text">@lang('Dashboard')</span></a>
    </li>
    <!-- STUDENT REGISTRATION -->
    <li class="nav-item dropdown">
        <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
            class="material-icons">contacts</i> <span class="nav-link-text">@lang('Students')</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
        <ul class="dropdown-menu" style="width: 100%;">
            <li class="nav-item">
                <a class="dropdown-item" href="{{url('register/tct_student')}}"><i class="material-icons">group_add</i> <span class="nav-link-text">@lang('New Student Form')</span></a>
            </li>
            <li class="nav-item">
                <a class="dropdown-item" href="{{url('tct_users/'.Auth::user()->school->code.'/1/0')}}"><i class="material-icons">group</i><span class="nav-link-text">@lang('Registered')</span></a>
            </li>
            <li class="nav-item">
                <a class="dropdown-item" href="#"><i class="material-icons">group</i><span class="nav-link-text">@lang('Inactive')</span></a>
            </li>
            <li class="nav-item"> 
                <a class="dropdown-item" href="{{url('tct_users_archive')}}"><i class="material-icons">group</i><span class="nav-link-text">@lang('Archived')</span></a>
            </li>
        </ul>

      </li>
      
      <!-- END OF STUDENT SECTION -->
    @if(Auth::user()->role != 'student')
    <li class="nav-item">
      <a class="nav-link" href="{{ url('school/sections?course=1') }}"><i class="material-icons">class</i> <span class="nav-link-text">@lang('Classes &amp; Sections')</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('school/houses') }}"><i class="material-icons">house</i> <span class="nav-link-text">@lang('Houses')</span></a>
    </li>
    <li class="nav-item" style="border-bottom: 2px solid #dbd8d8;"></li>
    <li class="nav-item dropdown">
        <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
            class="material-icons">monetization_on</i> <span class="nav-link-text">@lang('Fees')</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
        <ul class="dropdown-menu" style="width: 100%;">
            <li class="nav-item">
            <a class="nav-link" href="{{ url('fees/fee_type') }}"><i class="material-icons">dynamic_feed</i> <span class="nav-link-text">@lang('Fee Type')</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ url('fees/fee_channel') }}"><i class="material-icons">toc</i> <span class="nav-link-text">@lang('Fee Channel')</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ url('fees/tct_all') }}"><i class="material-icons">attach_money</i> <span class="nav-link-text">@lang('All Fees')</span></a>
            </li>
        </ul>
    </li>
    @endif

    @if(Auth::user()->role == 'admin')
    <li class="nav-item">
        @php 
            $count = \App\StudentInfo::where('session', now()->year)->where('assigned', 0)->count('id');
        @endphp
        <a class="nav-link" href="{{ url('fees/unassign') }}"><i class="material-icons">assignment_late</i> <span class="nav-link-text">@lang('Unassigned')</span>  <span class="badge"> {{$count}}</span></a></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('#') }}"><i class="material-icons">monetization_on</i> <span class="nav-link-text">@lang('Assigned')</span></a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('#') }}"><i class="material-icons">monetization_on</i> <span class="nav-link-text">@lang('Payments')</span></a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('#') }}"><i class="material-icons">monetization_on</i> <span class="nav-link-text">@lang('Remaining')</span></a>
    </li>
    <li class="nav-item" style="border-bottom: 1px solid #dbd8d8;"></li>
    <li class="nav-item dropdown">
        <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
            class="material-icons">date_range</i> <span class="nav-link-text">@lang('Attendance')</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
        <ul class="dropdown-menu" style="width: 100%;">
          <li class="nav-item">
            <a class="dropdown-item" href="#"><i class="material-icons">contacts</i> <span class="nav-link-text">@lang('Teacher Attendance')</span></a>
          </li>
          <li class="nav-item">
            <a class="dropdown-item" href="{{url('school/sections?att=1')}}"><i class="material-icons">contacts</i> <span
                class="nav-link-text">@lang('Student Attendance')</span></a>
          </li>
          <li class="nav-item">
            <a class="dropdown-item" href="#"><i class="material-icons">account_balance_wallet</i> <span class="nav-link-text">@lang('Staff Attendance')</span></a>
          </li>
        </ul>
    </li>
    @endif
    @if(Auth::user()->role != 'student')
    
    <li class="nav-item">
      <a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/0/1')}}"><i class="material-icons">contacts</i>
        <span class="nav-link-text">@lang('Teachers')</span></a>
    </li>
    @endif
    @if(Auth::user()->role == 'admin')
    <li class="nav-item dropdown">
      <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
          class="material-icons">line_style</i> <span class="nav-link-text">@lang('Exams')</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
      <ul class="dropdown-menu" style="width: 100%;">
        <!-- Dropdown menu links -->
        <li>
          <a class="dropdown-item" href="{{ url('exams/create') }}"><i class="material-icons">note_add</i> <span class="nav-link-text">@lang('Add Examination')</span></a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ url('exams/active') }}"><i class="material-icons">developer_board</i> <span
              class="nav-link-text">@lang('Active Exams')</span></a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ url('exams') }}"><i class="material-icons">settings</i> <span class="nav-link-text">@lang('Manage Examinations')</span></a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('grades/all-exams-grade') }}"><i class="material-icons">assignment</i> <span class="nav-link-text">@lang('Grades')</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('academic/routine') }}"><i class="material-icons">calendar_today</i> <span class="nav-link-text">@lang('Class Routine')</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('academic/syllabus') }}"><i class="material-icons">vertical_split</i> <span class="nav-link-text">@lang('Syllabus')</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('academic/notice') }}"><i class="material-icons">announcement</i> <span class="nav-link-text">@lang('Notice')</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('academic/event') }}"><i class="material-icons">event</i> <span class="nav-link-text">@lang('Event')</span></a>
    </li>
    <li class="nav-item" style="border-bottom: 1px solid #dbd8d8;"></li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('settings.index') }}"><i class="material-icons">settings</i> <span class="nav-link-text">@lang('Academic Settings')</span></a>
    </li>
    <li class="nav-item dropdown">
      <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
          class="material-icons">chrome_reader_mode</i> <span class="nav-link-text">@lang('Manage GPA')</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
      <ul class="dropdown-menu" style="width: 100%;">
        <!-- Dropdown menu links -->
        <li>
          <a class="dropdown-item" href="{{ url('gpa/all-gpa') }}"><i class="material-icons">developer_board</i> <span
              class="nav-link-text">@lang('All GPA')</span></a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ url('gpa/create-gpa') }}"><i class="material-icons">note_add</i> <span class="nav-link-text">@lang('Add New GPA')</span></a>
        </li>
      </ul>
    </li>
    @endif
    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'accountant')
    <li class="nav-item dropdown">
      <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
          class="material-icons">monetization_on</i> <span class="nav-link-text">@lang('Fees Generator')</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
      <ul class="dropdown-menu" style="width: 100%;">
        <!-- Dropdown menu links -->
        <li>
          <a class="dropdown-item" href="{{ url('fees/all') }}"><i class="material-icons">developer_board</i> <span class="nav-link-text">@lang('Generate Form')</span></a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ url('fees/create') }}"><i class="material-icons">note_add</i> <span class="nav-link-text">@lang('Add Fee Field')</span></a>
        </li>
      </ul>
    </li>
    @endif
     
    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'accountant')
    <li class="nav-item dropdown">
      <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
          class="material-icons">account_balance_wallet</i> <span class="nav-link-text">@lang('Manage Accounts')</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
      <ul class="dropdown-menu" style="width: 100%;">
        <!-- Dropdown menu links -->
        <li>
          <a class="dropdown-item" href="{{url('users/'.Auth::user()->school->code.'/accountant')}}"><i class="material-icons">account_balance_wallet</i>
            <span class="nav-link-text">@lang('Accountant List')</span></a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ url('accounts/sectors') }}"><i class="material-icons">developer_board</i>
          <span class="nav-link-text">@lang('Add Account Sector')</span></a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ url('accounts/expense') }}"><i class="material-icons">note_add</i> <span
              class="nav-link-text">@lang('Add New Expense')</span></a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ url('accounts/expense-list') }}"><i class="material-icons">developer_board</i>
            <span class="nav-link-text">@lang('Expense List')</span></a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ url('accounts/income') }}"><i class="material-icons">note_add</i> <span class="nav-link-text">@lang('Add New Income')</span></a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ url('accounts/income-list') }}"><i class="material-icons">developer_board</i>
            <span class="nav-link-text">@lang('Income List')</span></a>
        </li>
      </ul>
    </li>
    @endif
    @if(Auth::user()->role == 'student')
    <li class="nav-item">
      <a class="nav-link active" href="{{ url('attendances/0/'.Auth::user()->id.'/0') }}"><i class="material-icons">date_range</i>
        <span class="nav-link-text">@lang('My Attendance')</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('courses/0/'.Auth::user()->section_id) }}"><i class="material-icons">subject</i>
        <span class="nav-link-text">@lang('My Courses')</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('grades/'.Auth::user()->id) }}"><i class="material-icons">bubble_chart</i> <span
          class="nav-link-text">@lang('My Grade')</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('stripe/charge')}}"><i class="material-icons">payment</i> <span class="nav-link-text">@lang('Payment')</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('stripe/receipts')}}"><i class="material-icons">receipt</i> <span class="nav-link-text">@lang('Receipt')</span></a>
    </li>
    @endif
    {{--<div style="text-align:center;">@lang('Student')</div>--}}
    {{--<div style="text-align:center;">@lang('Teacher')</div>--}}
    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'librarian')
    <li class="nav-item dropdown">
      <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
          class="material-icons">local_library</i> <span class="nav-link-text">@lang('Manage Library')</span> <i class="material-icons pull-right">keyboard_arrow_down</i></a>
      <ul class="dropdown-menu" style="width: 100%;">
        <!-- Dropdown menu links -->
        <li>
          <a class="dropdown-item" href="{{url('users/'.Auth::user()->school->code.'/librarian')}}"><i class="material-icons">local_library</i>
            <span class="nav-link-text">@lang('Librarian List')</span></a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('library.books.index') }}"><i class="material-icons">developer_board</i>
            <span class="nav-link-text">@lang('All Books')</span></a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ url('library/issued-books') }}"><i class="material-icons">developer_board</i>
            <span class="nav-link-text">@lang('All Issued Books')</span></a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ url('library/issue-books') }}"><i class="material-icons">receipt</i> <span
              class="nav-link-text">@lang('Issue Book')</span></a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('library.books.create') }}"><i class="material-icons">note_add</i> <span
              class="nav-link-text">@lang('Add New Book')</span></a>
        </li>
      </ul>
    </li>
    @endif
    @if(Auth::user()->role == 'teacher')
    <li class="nav-item">
      <a class="nav-link" href="{{ url('courses/'.Auth::user()->id.'/0') }}"><i class="material-icons">import_contacts</i>
        <span class="nav-link-text">@lang('My Courses')</span></a>
    </li>
    @endif
  </ul>
  