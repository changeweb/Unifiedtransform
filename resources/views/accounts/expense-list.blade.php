@extends('layouts.app')
@section('title', __('Expense List'))
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
          <br>
          <div class="row">
            <div class="col-md-6">
              <div class="panel panel-default">
              <div class="page-panel-title">@lang('View List of  Expense')
                <button class="btn btn-xs btn-success pull-right" role="button" id="btnPrint" ><i class="material-icons">print</i> @lang('Print This Expense List')</button></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" action="{{url('/accounts/list-expense')}}" method="post">
                      {{ csrf_field() }}
                      <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                          <label for="year" class="col-md-4 control-label">@lang('Year')</label>

                          <div class="col-md-6">
                              <input id="date" type="text" class="form-control datepicker" name="year" value="{{ old('year') }}" placeholder="@lang('Year')" required>

                              @if ($errors->has('year'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('year') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                          <button type="submit" class="btn btn-danger">@lang('Get Expense List')</button>
                        </div>
                      </div>
                    </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div style="width:100%; height: 300px;">
                <canvas id="canvas"></canvas>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              @isset($expenses)
                    <div class="table-responsive">
                      <table class="table table-data-div table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">@lang('Sector Name')</th>
                            <th scope="col">@lang('Amount')</th>
                            <th scope="col">@lang('Description')</th>
                            <th scope="col">@lang('Year')</th>
                            <th scope="col">@lang('Action')</th>
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
                            <td><a title='Edit' class='btn btn-info btn-sm' href='{{url("accounts/edit-expense")}}/{{$expense->id}}'>@lang('Edit')</a></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <div id="printDiv"  class="visible-print">
                      <h2 style="text-align:center;">{{Auth::user()->school->name}}</h2>
                      <h4 style="text-align:center;">@lang('Expense List')</h4>
                      <table style="border: 1px solid #888888;border-collapse: collapse;background-color: #f5f5f5;" cellpadding="5">
                        <thead>
                          <tr>
                            <th style="border: 1px solid #888888;">#</th>
                            <th style="border: 1px solid #888888;">@lang('Sector Name')</th>
                            <th style="border: 1px solid #888888;">@lang('Amount')</th>
                            <th style="border: 1px solid #888888;">@lang('Description')</th>
                            <th style="border: 1px solid #888888;">@lang('Year')</th>
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
            printWindow.document.write('<html><head><title>@lang('Expense List')</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.document.body.innerHTML = divContents;
            printWindow.print();
        });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
	<style>
		canvas {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
    </style>
    <script>
        'use strict';

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };

		var color = Chart.helpers.color;
		var config = {
			type: 'bar',
			data: {
				datasets: [{
                    label: @json( __('Expense')),
					backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
					borderColor: window.chartColors.red,
					fill: false,
					data: [@foreach($expenses as $s)
                        {
                            t:"{{Carbon\Carbon::parse($s->created_at)->format('Y-d-m')}}",
                            y:{{$s->amount}}
                        },
                        @endforeach]
        }]
                },
			options: {
				title: {
                    display: true,
					text: @json( __('Expense (In Dollar) in Time Scale'))
				},
        maintainAspectRatio: false,
				scales: {
					xAxes: [{
						type: @json( __('time')),
						time: {
							parser: 'YYYY-DD-MM',
							tooltipFormat: 'll HH:mm'
						},
						scaleLabel: {
							display: true,
							labelString: @json( __('Date'))
						}
					}],
					yAxes: [{
						scaleLabel: {
							display: true,
							labelString: @json( __('Money'))
						}
					}]
				},
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);

		};
	    </script>
@endsection
