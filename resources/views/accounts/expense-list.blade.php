@extends('layouts.app')
@section('title', 'Expense List')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">View List of Expense
                <button class="btn btn-xs btn-success pull-right" role="button" id="btnPrint" ><i class="material-icons">print</i> Print This Expense List</button></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" action="{{url('/accounts/list-expense')}}" method="post">
                      {{ csrf_field() }}
                      <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                          <label for="year" class="col-md-4 control-label">Year</label>

                          <div class="col-md-6">
                              <input id="date" type="text" class="form-control datepicker" name="year" value="{{ old('year') }}" placeholder="Year" required>

                              @if ($errors->has('year'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('year') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                          <button type="submit" class="btn btn-danger">Get Expense List</button>
                        </div>
                      </div>
                    </form>
                    @isset($expenses)
                    <div class="table-responsive">
                      <table class="table table-data-div table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sector Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Description</th>
                            <th scope="col">Year</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($expenses as $expense)
                          <tr>
                            <td>{{($loop->index + 1)}}</td>
                            <td>{{$expense->name}}</td>
                            <td>{{$expense->amount}}</td>
                            <td>{{$expense->description}}</td>
                            <td>{{Carbon\Carbon::parse($expense->created_at)->format('Y')}}</td>
                            <td><a title='Edit' class='btn btn-info btn-sm' href='{{url("accounts/edit-expense")}}/{{$expense->id}}'>Edit</a></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <div id="printDiv"  class="visible-print">
                      <h2 style="text-align:center;">{{Auth::user()->school->name}}</h2>
                      <h4 style="text-align:center;">Expense List</h4>
                      <table style="border: 1px solid #888888;border-collapse: collapse;background-color: #f5f5f5;" cellpadding="5">
                        <thead>
                          <tr>
                            <th style="border: 1px solid #888888;">#</th>
                            <th style="border: 1px solid #888888;">Sector Name</th>
                            <th style="border: 1px solid #888888;">Amount</th>
                            <th style="border: 1px solid #888888;">Description</th>
                            <th style="border: 1px solid #888888;">Year</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($expenses as $expense)
                          <tr>
                            <td style="border: 1px solid #888888;">{{($loop->index + 1)}}</td>
                            <td style="border: 1px solid #888888;">{{$expense->name}}</td>
                            <td style="border: 1px solid #888888;">{{$expense->amount}}</td>
                            <td style="border: 1px solid #888888;">{{$expense->description}}</td>
                            <td style="border: 1px solid #888888;">{{Carbon\Carbon::parse($expense->created_at)->format('Y')}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      </div>
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
$('.datepicker').datepicker({
  format: 'yyyy',
  viewMode: "years",
  minViewMode: "years",
  autoclose:true,
});
$("#btnPrint").on("click", function () {
            var divContents = $("#printDiv").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>Expense List</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.document.body.innerHTML = divContents;
            printWindow.print();
        });
</script>
@endsection
