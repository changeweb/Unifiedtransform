@extends('layouts.app')
@section('title', __('Add New Income'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-8" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">@lang('Add New Income / Create Invoice')</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" action="{{url('accounts/create-income')}}" method="post">
                      {{ csrf_field() }}
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-4 control-label">@lang('Sector Name')</label>

                          <div class="col-md-6">
                              <select class="form-control" id="name" name="name">
                                @foreach($sectors as $sector)
                                  <option>{{$sector->name}}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      {{--
                      <div class="form-group{{ $errors->has('income_source') ? ' has-error' : '' }}">
                          <label for="income_source" class="col-md-4 control-label">@lang('Income Source'): </label>

                          <div class="col-md-6">
                              <select class="form-control" id="income_source" name="income_source">
                                <option value="1" selected>@lang('Student')</option>
                                <option value="2">@lang('Other')</option>
                              </select>

                              @if ($errors->has('income_source'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('income_source') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('invoice_type') ? ' has-error' : '' }}">
                          <label for="invoice_type" class="col-md-4 control-label">@lang('Invoice Type'): </label>

                          <div class="col-md-6">
                              <select class="form-control" id="invoice_type" name="invoice_type">
                                <option value="1" selected>@lang('Single Invoice')</option>
                                <option value="2">@lang('Mass Invoice')</option>
                              </select>

                              @if ($errors->has('invoice_type'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('invoice_type') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('student_section') ? ' has-error' : '' }} student-by-section">
                          <label for="student_section" class="col-md-4 control-label">@lang('Students of'): </label>

                          <div class="col-md-6">
                              <select class="form-control" id="student_section" name="student_section">
                                @foreach($sections as $section)
                                  <option value="{{$section->id}}">@lang('Class'): {{$section->class->class_number}} @lang('Section'): {{$section->section_number}}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('student_section'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('student_section') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('section_students') ? ' has-error' : '' }} student-by-section">
                          <label for="section_students" class="col-md-4 control-label">@lang('Student'):</label>

                          <div class="col-md-6">
                              <select class="form-control" id="section_students" name="section_students">
                                @foreach($students as $student)
                                  <option value="{{$student->id}}" data-section="{{$student->section_id}}">{{$student->name}}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('section_students'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('section_students') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>--}}
                      <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                          <label for="amount" class="col-md-4 control-label">@lang('Amount')</label>

                          <div class="col-md-6">
                              <input id="amount" type="number" class="form-control" name="amount" value="{{ old('amount') }}" placeholder="@lang('Amount')" required>

                              @if ($errors->has('amount'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('amount') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      {{--
                      <div class="form-group{{ $errors->has('payment_method') ? ' has-error' : '' }}">
                          <label for="payment_method" class="col-md-4 control-label">@lang('Payment Method'): </label>

                          <div class="col-md-6">
                              <select class="form-control" id="payment_method" name="payment_method">
                                <option value="1">@lang('Cash')</option>
                                <option value="2">@lang('Bank Check')</option>
                                <option value="3">@lang('Credit Card')</option>
                              </select>

                              @if ($errors->has('payment_method'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('payment_method') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('paid_status') ? ' has-error' : '' }}">
                          <label for="paid_status" class="col-md-4 control-label">@lang('Payment Status'): </label>

                          <div class="col-md-6">
                              <select class="form-control" id="paid_status" name="paid_status">
                                <option value="1" selected>@lang('Paid')</option>
                                <option value="2">@lang('Unpaid')</option>
                              </select>

                              @if ($errors->has('paid_status'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('paid_status') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>--}}
                      <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                          <label for="description" class="col-md-4 control-label">@lang('Description')</label>

                          <div class="col-md-6">
                              <textarea rows="3" id="description" class="form-control" name="description" placeholder="@lang('Description')" required>{{ old('description') }}</textarea>

                              @if ($errors->has('description'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                          <button type="submit" class="btn btn-danger">@lang('Save')</button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
