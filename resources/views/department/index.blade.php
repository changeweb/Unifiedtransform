@extends('layouts.app')

@section('title', __('Manage Schools'))

@section('content')
    <div class="container-fluid">
        <div class="col-md-12" id="main-container">
            <!-- displays flash error messages if any -->
            @if(Session::has('status'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">  x  </button>
                <strong> {{ session('status') }} <br><br></strong>
            </div>
            @endif

            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#departmentModal">+ @lang('Create Department')</button>
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
                                            <input type="text" class="form-control" id="department_name" name="department_name"  placeholder="@lang('English, Mathematics,...')">
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

            <div class="panel panel-default">
                <div class="panel-body table-responsive">
                    <h2>@lang('School List')</h2>
                    <h4>@lang('Manage Departments')</h4>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('School')</th>
                                <th scope="col">@lang('Edit')</th>
                                <th scope="col">-@lang('Delete')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                                <tr>
                                    <td>{{($loop->index + 1)}}</td>
                                    <td><small>{{$department->department_name}}</small></td>
                                    <td><small>{{$department->school->name}}</small></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#departmentModal{{$department->id}}">@lang('Edit Department')</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="departmentModal{{$department->id}}" tabindex="-1" role="dialog" aria-labelledby="departmentModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title" id="departmentModalLabel">@lang('Create Department')</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" action="{{ route('department.update', ['department' => $department->id]) }}" method="post">
                                                            {{csrf_field()}}
                                                            <div class="form-group">
                                                                <label for="department_name" class="col-sm-2 control-label">@lang('Department Name')</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="department_name" name="department_name" value="{{ $department->department_name }}" placeholder="@lang('English, Mathematics,...')">
                                                                    <input type="hidden" class="form-control"  name="school_id" value="{{ $department->school_id }}" ">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-2 col-sm-10">
                                                                    <button type="submit" class="btn btn-success btn-sm">@lang('Update')</button>
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
                                        <form action="{{ route('department.destroy', ['id' => $department->id]) }}" method="POST">
                                           {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm">@lang('Delete Department')</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $departments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection