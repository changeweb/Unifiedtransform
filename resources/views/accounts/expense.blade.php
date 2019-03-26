@extends('layouts.app')
@section('title', 'Add New Expense')
@section('content')
        <div class="col-md-8" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">Add New Expense</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" action="{{url('accounts/create-expense')}}" method="post">
                      {{ csrf_field() }}
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-4 control-label">Sector Name</label>

                          <div class="col-md-6">
                              <select  class="form-control" name="name">
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
                      <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                          <label for="amount" class="col-md-4 control-label">Amount</label>

                          <div class="col-md-6">
                              <input id="amount" type="number" class="form-control" name="amount" value="{{ old('amount') }}" placeholder="Amount" required>

                              @if ($errors->has('amount'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('amount') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                          <label for="description" class="col-md-4 control-label">Description</label>

                          <div class="col-md-6">
                              <textarea rows="3" id="description" class="form-control" name="description" placeholder="Description" required>{{ old('description') }}</textarea>

                              @if ($errors->has('description'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                          <button type="submit" class="btn btn-danger">Save</button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
