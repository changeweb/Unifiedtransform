@extends('layouts.app')
@section('title', 'Account Sectors')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="row">
                <div class="col-md-6">
                    <br>
                    <div class="panel panel-default">
                        <div class="page-panel-title">Account Sectors</div>

                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form class="form-horizontal" action="{{url('/accounts/create-sector')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Sector Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ (!empty($sector->name))?$sector->name:old('name') }}" placeholder="Sector Name" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-4 control-label">Sector Type</label>

                                <div class="col-md-6">
                                    <select  class="form-control" name="type">
                                        <option value="income">Income</option>
                                        <option value="expense">Expense</option>
                                    </select>

                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
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
                <div class="col-md-6">
                    <br>
                    <div style="width:100%;">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>All Created Sectors</h3>
                    <table class="table table-striped table-data-div">
                        <thead>
                            <tr>
                                <th>Sector Name</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($sectors as $sector)
                            <tr>
                                <td>{{$sector->name}}</td>
                                <td>{{$sector->type}}</td>
                                <td>
                                    <a href="{{url('accounts/edit-sector/'.$sector->id)}}" class="btn btn-danger btn-xs" role="button">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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
                    label: 'Income',
					backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
					borderColor: window.chartColors.green,
					fill: false,
					data: [@foreach($incomes as $s)
                        {
                            t:"{{Carbon\Carbon::parse($s->created_at)->format('Y-d-m')}}",
                            y:{{$s->amount}}
                        },
                        @endforeach]
                },{
                    label: 'Expense',
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
					text: 'Income and Expense (In Dollar) in Time Scale'
				},
				scales: {
					xAxes: [{
						type: 'time',
						time: {
							parser: 'YYYY-DD-MM',
							tooltipFormat: 'll HH:mm'
						},
						scaleLabel: {
							display: true,
							labelString: 'Date'
						}
					}],
					yAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Money'
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
