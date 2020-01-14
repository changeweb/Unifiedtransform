@extends('layouts.app')

@section('title', __('Unassigned'))

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>

        <div class="col-md-10" id="main-container">
            <br>
            <h4>Unassigned Students - {{now()->year}}</h4>
            <br>
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="text-white bg-danger">{{$error}}</div>
                {{-- <span class="error">{{ $error}}</span> --}}
            @endforeach
            <br>
        @endif         
            <div class="panel panel-default">
                @if($unassigned->first())
                    <table id="myTable" class='table'>
                        <thead>
                            <th class="text-center">#</th>
                            <th class="text-center">TCT ID</th>
                            <th class="text-center">Full Name</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Form</th>
                            <th class="text-center">House</th>
                            {{-- <th class="text-center">Number of Channels</th> --}}
                            <th class="text-center">Assign</th>
                        </thead>
                        <tbody>
                            @foreach($unassigned as $unassign)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$unassign->student->student_code}}</td>
                                    <td>
                                        <a href="{{url('user/'.$unassign->student->student_code)}}">{{($unassign->student->name == '')?$unassign->student->given_name.' '.$unassign->student->lst_name:$unassign->student->name}}</a>
                                    </td>
                                    <td class="text-center">{{$unassign->category_id}}</td>
                                    <td>{{($unassign->student->active)?'Active / '.ucfirst($unassign->group):'Inactive'}}</td>
                                    <td class="text-center">{{$unassign->section->class->class_number}}{{$unassign->section->section_number}} (#{{$unassign->form_num}})</td>
                                    <td class="text-center">{{$unassign->house->house_abbrv}}</td>
                                    <td class="text-center">
                                        @component('components.fee-type-form', [
                                            'buttonTitle' => 'Assign Fees',
                                            'modal_name' => 'myModal'.$unassign->id,
                                            'title' => 'Assign Fees',
                                            'put_method' => '',
                                            'url' => url('fees/assign'),
                                        ])
                                            @slot('buttonType')
                                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal{{$unassign->id}}"><i class="material-icons">assignment_returned</i>  
                                            @endslot
                                            @slot('form_content')
                                                <input type="hidden" value="{{$unassign->student->id}}" name="user_id">
                                                <div class="row form-group">
                                                    <label for="channel" class="col-sm-4 control-label">@lang('Fee Channel')</label>
                                                    <div class="col-sm-8">
                                                        <select id="channel" class="form-control" name="channel">
                                                            @php
                                                                $channels = \App\FeeChannel::where('active', 1)->where('session', now()->year)->get();
                                                            @endphp
                                                                <option value="">Select Channel</option>
                                                            @foreach ($channels as $channel)
                                                                <option value="{{$channel->id}}">{{ucfirst($channel->name)}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr>    
                                                <div class="row" id="feeToAssign">
                                                </div>
                                            @endslot
                                        @endcomponent
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                <div class="panel-body">
                    @lang('No Related Data Found.')
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsFiles')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
    <script>
        $(document).ready(function(){
            $('#channel').on('change', function(){
			if($(this).val() != 0){
				$.ajax({
				url: '{{url("/fees/assignListAction")}}',
				type: "GET",
				data: {
                    "_token": "{{ csrf_token() }}",
					channel_id: $(this).val(),
				},
				success: function(data){
						$('#feeToAssign').html(data);
				}
			});
			}
			
		});
		});
    </script>

@endsection
