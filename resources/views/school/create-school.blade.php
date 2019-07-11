@extends('layouts.app')

@section('title', __('Manage Schools'))

@section('content')
<div class="container-fluid">
    <div class="row">
      @if(\Auth::user()->role != 'master')
        <div class="col-md-2" id="side-navbar">
          @include('layouts.leftside-menubar')
        </div>
      @endif
        <div class="col-md-{{ (\Auth::user()->role == 'master')? 12 : 10 }}" id="main-container">
            @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="panel panel-default">
              <div class="panel-body table-responsive">
                @if(\Auth::user()->role == 'master')
                  @include('layouts.master.create-school-form')
                  <h2>@lang('School List')</h2>
                @endif
                <h4>@lang('Manage Departments, Classs, Sections, Student Promotion, Course')</h4>
                <table class="table table-condensed" style="{{(\Auth::user()->role == 'master')?'':'width:800px'}}">
                  <thead>
                    <tr>
                      @if(\Auth::user()->role == 'master')
                        <th scope="col">#</th>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Code')</th>
                        <th scope="col">@lang('About')</th>
                      @endif
                      @if(\Auth::user()->role == 'admin')
                        {{--<th scope="col">@lang('Theme')</th>--}}
                        <th scope="col">@lang('Department')</th>
                        <th scope="col">@lang('Classes')</th>
                        {{-- <th scope="col">@lang('Students')</th>
                        <th scope="col">@lang('Teachers')</th> --}}
                      @endif
                      @if(\Auth::user()->role == 'master')
                        <th scope="col">Edit</th>
                        <th scope="col">+Admin</th>
                        <th scope="col">View Admins</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($schools as $school)
                    @if(\Auth::user()->role == 'master' || \Auth::user()->school_id == $school->id)
                    <tr>
                      @if(\Auth::user()->role == 'master')
                      <td>{{($loop->index + 1)}}</td>
                      <td><small>{{$school->name}}</small></td>
                      <td><small>{{$school->code}}</small></td>
                      <td><small>{{$school->about}}</small></td>
                      @endif
                      @if(\Auth::user()->school_id == $school->id)
                        {{--<td>
                          @include('layouts.master.theme-form')
                        </td>--}}
                      <td>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#departmentModal">+ @lang('Create Department')</button>
                        <!-- Modal -->
                                  <div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="departmentModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                          <h4 class="modal-title" id="departmentModalLabel">@lang('Create Department')</h4>
                                        </div>
                                        <div class="modal-body">
                                          <form class="form-horizontal" action="{{url('school/add-department')}}" method="post">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                              <label for="department_name" class="col-sm-2 control-label">@lang('Department Name')</label>
                                              <div class="col-sm-10">
                                                <input type="text" class="form-control" id="department_name" name="department_name" placeholder="English, Mathematics,...">
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger btn-sm">@lang('Submit')</button>
                                              </div>
                                            </div>
                                          </form>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">@lang('Close')</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                      </td>
                      <td>
                        <a href="#collapse{{($loop->index + 1)}}" role="button" class="btn btn-danger btn-sm" data-toggle="collapse" aria-expanded="false" aria-controls="collapse{{($loop->index + 1)}}"><i class="material-icons">class</i> @lang('Manage Class, Section')
                        </a>
                      </td>
                      {{-- <td>
                        <a href="{{url('users/'.$school->code.'/1/0')}}"><small>@lang('View All Students')</small></a>
                      </td>
                      <td>
                        <a href="{{url('users/'.$school->code.'/0/1')}}"><small>@lang('View All Teachers')</small></a>
                      </td> --}}
                      @endif
                      @if(\Auth::user()->role == 'master')
                        <td>
                          <a class="btn btn-success btn-sm" role="button" href="{{url('school/'.$school->id)}}"><small>Edit School</small></a>
                        </td>
                        <td>
                          <a class="btn btn-danger btn-sm" role="button" href="{{url('register/admin/'.$school->id.'/'.$school->code)}}"><small>+ Create Admin</small></a>
                        </td>
                        <td>
                          <a class="btn btn-success btn-sm" role="button" href="{{url('school/admin-list/'.$school->id)}}"><small>@lang('View Admins')</small></a>
                        </td>
                      @endif
                    </tr>
                    @if(\Auth::user()->school_id == $school->id)
                    <tr class="collapse" id="collapse{{($loop->index + 1)}}" aria-labelledby="heading{{($loop->index + 1)}}" aria-expanded="false">
                      <td colspan="12">
                        @include('layouts.master.add-class-form')
                          <div><small>@lang('Click Class to View All Sections')</small></div>
                            <div class="row">
                              @foreach($classes as $class)
                                @if($class->school_id == $school->id)
                                <div class="col-sm-3">
                                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal{{$class->id}}" style="margin-top: 5%;">@lang('Manage') {{$class->class_number}} {{!empty($class->group)? '- '.$class->group:''}}</button>
                                  <!-- Modal -->
                                  <div class="modal fade" id="myModal{{$class->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                          <h4 class="modal-title" id="myModalLabel">@lang('All Sections of Class') {{$class->class_number}}</h4>
                                        </div>
                                        <div class="modal-body">
                                          <ul class="list-group">
                                            @foreach($sections as $section)
                                              @if($section->class_id == $class->id)
                                              <li class="list-group-item">Section {{$section->section_number}} &nbsp;
                                                <a class="btn btn-xs btn-warning" href="{{url('courses/0/'.$section->id)}}">@lang('View All Assigned Courses')</a>
                                                <span class="pull-right"> &nbsp;&nbsp;
                                                  <a  class="btn btn-xs btn-success" href="{{url('school/promote-students/'.$section->id)}}">+ @lang('Promote Students')</a>
                                                  {{-- &nbsp;<a class="btn btn-xs btn-primary" href="{{url('register/student/'.$section->id)}}">+ @lang('Register Student')</a> --}}
                                                </span>
                                                @include('layouts.master.add-course-form')
                                              </li>
                                              @endif
                                            @endforeach
                                          </ul>
                                          @include('layouts.master.create-section-form')
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">@lang('Close')</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                @endif
                              @endforeach
                            </div>
                      </td>
                    </tr>
                    @endif
                    @endif
                    @endforeach
                  </tbody>
                </table>
                <br>
                @foreach($schools as $school)
                @if(\Auth::user()->role == 'admin' && \Auth::user()->school_id == $school->id)
                <h4>Add Users</h4>
                <table class="table table-condensed" style="width:600px">
                  <thead>
                    <tr>
                        <th scope="col">+@lang('Student')</th>
                        <th scope="col">+@lang('Teacher')</th>
                        <th scope="col">+@lang('Accountant')</th>
                        <th scope="col">+@lang('Librarian')</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    
                        <td>
                          <a class="btn btn-info btn-sm" href="{{url('register/student')}}">+ Add Student</a>
                          <br>
                          <h5>Or, Mass upload Excel</h5>
                          @component('components.excel-upload-form', ['type'=>'student'])
                          @endcomponent
                        </td>
                        <td>
                          <a class="btn btn-success btn-sm" href="{{url('register/teacher')}}">+ Add Teacher</a>
                          <br>
                          <h5>Or, Mass upload Excel</h5>
                          @component('components.excel-upload-form', ['type'=>'teacher'])
                          @endcomponent
                        </td>
                        <td>
                          <a class="btn btn-default btn-sm" href="{{url('register/accountant')}}">+ @lang('Add Accountant')</a>
                        </td>
                        <td>
                          <a class="btn btn-warning btn-sm" href="{{url('register/librarian')}}">+ @lang('Add Librarian')</a>
                        </td>
                    </tr>
                  </tbody>
                </table>
                <br>
                <h4>@lang('Upload')</h4>
                <table class="table table-condensed" style="width:400px">
                  <thead>
                    <tr>
                      <th scope="col">+@lang('Notice')</th>
                      <th scope="col">+@lang('Event')</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                          <a class="btn btn-info btn-sm" href="{{ url('academic/notice') }}"><i class="material-icons">developer_board</i> @lang('Upload Notice')</a>
                        </td>
                        <td>
                          <a class="btn btn-info btn-sm" href="{{ url('academic/event') }}"><i class="material-icons">developer_board</i> @lang('Upload Event')</a>
                        </td>
                    </tr>
                  </tbody>
                </table>
                  @break
                @endif
                @endforeach
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
