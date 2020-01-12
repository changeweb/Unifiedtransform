<!-- Include Service into Blade file -->

@php $userSer = $user; @endphp
@inject('userSer', 'App\Services\User\UserService')

@if($errors->any())
@foreach ($errors->all() as $error)
    <div class="bg-danger text-white">{{$error}}</div>
@endforeach
<br>
@endif
@if(isset($error2))
    <div class="bg-danger text-white">{{$error}}</div>
@endif

<div>
    <div class="col-md-2" text-center>
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
        <hr>
        <!-- INACTIVE / REINSTATE BUTTONS -->
        <div class="row text-center">
            @if ($user->active)
                @include('layouts.master.set-inactive')
            @else
                @if($userSer->checkReinstate($user))
                    @if($userSer->getReinstateRequest($user)->approved)
                        @include('layouts.master.set-inactive')
                    @else
                        @include('layouts.master.reinstate-approval')
                    @endif
                @else
                    @include('layouts.master.reinstate-form')
                @endif
            @endif

        </div>
        <br>
        <!-- PROMOTE BUTTON -->
        <div class="row text-center">
            @if($user->active & $user->studentInfo->session != date('Y'))
                @include('layouts.master.promote-tct-student')
                <br>
            @endif
        </div>
        <br>
        <!-- EDIT BUTTONS -->
        <div class="row text-center">
            @include('layouts.master.edit-details-form')
        </div>
    </div>
    <div class="col-md-10" id="main-container">
        <!-- STUDENT SUMMARY -->
        <div class="row">
                @component('components.tct-student-summary',['user'=>$user])
                @endcomponent 
        </div>
        <hr>
        <div class="row">
            <!-- NAV TABS -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active " data-toggle="tab" href="#general">Administration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#finance">Finance</a>
                </li>
            </ul>

            <!-- NAV TABS CONTENT -->
            <div class="tab-content">
                <!-- Admin Details-->
                <div class="tab-pane active" id="general">
                    {{-- <button class="btn btn-xs btn-success pull-right" role="button" id="btnPrint"><i class="material-icons">print</i> @lang('Print Profile')</button> --}}
                    {{-- <div class="" id="profile-content">
                        <div class="col-md-12">
                        <div class="col-xs-8">
                            <h2>{{$user->section->class->school->name}}</h2>
                            <div style="font-size: 10px;">{{$user->section->class->school->about}}</div>
                        </div>
                        <div class="col-xs-4">
                            <h3>@lang('Student Profile')</h3>
                            <div style="font-size: 10px;">@lang('Printing Date'): {{Carbon\Carbon::now()->format('d/m/Y')}}</div>
                        </div>
                        </div>
                    </div> --}}
                    <br/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-xs-12">
                                <table class="table">
                                    <tr>
                                        <td colspan="4" class="bg-dark text-white text-center">Administration Information</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('TCT ID'):</td>
                                        <td>{{$user->studentInfo['tct_id']}}</td>
                                        <td>@lang('Session'):</td>
                                        <td>{{$user->studentInfo['session']}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Form'):</td>
                                        <td>{{$user->studentInfo->section->class->class_number}}{{$user->studentInfo->section->section_number}}</td>
                                        <td>@lang('Form #'):</td>
                                        <td>{{$user->studentInfo['form_num']}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('House'):</td>
                                        <td>{{$user->studentInfo->house->house_name}}</td>
                                        <td>@lang('Start Date')</td>
                                        <td>{{Carbon\Carbon::parse($user->studentInfo['created_at'])->format('d/m/Y')}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Status'):</td>
                                        <td>{{ucfirst($user->studentInfo->group)}}</td>
                                        <td>@lang('Registration Date')</td>
                                        <td>{{Carbon\Carbon::parse($user->studentInfo['updated_at'])->format('d/m/Y')}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Notes'):</td>
                                        <td colspan="2">{{$user->studentInfo['reg_notes']}}</td>
                                    </tr>
                                    @if(!$user->active)
                                        <tr>
                                            <td colspan="4" class="bg-info text-white text-center"><b>Inactive details</b></td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Type'):</td>
                                            <td>{{ucfirst($userSer->getInactiveRequest($user)->type)}}</td>
                                            <td>@lang('Inactive Date')</td>
                                            <td>{{Carbon\Carbon::parse($userSer->getInactiveRequest($user)->created_at)->format('d/m/Y')}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Inactive Notes'):</td>
                                            <td colspan="3">{{$userSer->getInactiveRequest($user)->notes}}</td>
                                        </tr>
                                        @if($userSer->checkReinstate($user))
                                            <tr>
                                                <td colspan="4">
                                                    Reinstated on {{Carbon\Carbon::parse($userSer->getReinstateRequest($user)->created_at)->format('d/m/Y')}}
                                                    - {{$userSer->getReinstateRequest($user)->notes}}
                                                </td>
                                            </tr>
                                        @endif


                                    @endif



                                    <tr>
                                        <td colspan="4" class="bg-dark text-white text-center">Personal details</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Last Name'):</td>
                                        <td>{{$user->lst_name}}</td>
                                        <td>@lang('Given Names')</td>
                                        <td>{{$user->given_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Date of Birth'):</td>
                                        <td>{{Carbon\Carbon::parse($user->studentInfo->birthday)->format('d/m/Y')}}</td>
                                        <td>@lang('Category'):</td>
                                        <td>{{$user->studentInfo['category_id']}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Nationality'):</td>
                                        <td>{{$user->nationality}}</td>
                                        <td>@lang('Village'):</td>
                                        <td>{{$user->village}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Church'):</td>
                                        <td colspan="2">{{$user->studentInfo['church']}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="bg-dark text-white text-center">Health and Contact Details</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Health Conditions'):</td>
                                        <td>{{$user->health_conditions}}</td>
                                        <td>@lang('Blood Type'):</td>
                                        <td>{{$user->blood_group}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Father\'s Name'):</td>
                                        <td>{{$user->studentInfo['father_name']}}</td>
                                        <td>@lang('Mother\'s Name'):</td>
                                        <td>{{$user->studentInfo['mother_name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Father\'s Phone Number'):</td>
                                        <td>{{$user->studentInfo['father_phone_number']}}</td>
                                        <td>@lang('Mother\'s Phone Number'):</td>
                                        <td>{{$user->studentInfo['mother_phone_number']}}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Father\'s Occupation'):</td>
                                        <td>{{$user->studentInfo['father_occupation']}}</td>
                                        <td>@lang('Mother\'s Occupation'):</td>
                                        <td>{{$user->studentInfo['mother_occupation']}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Finance Details -->
                <div class="tab-pane" id="finance">
                    <br/>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <td  class="bg-dark text-white text-center">Financial Information</td>
                                </tr>
                            </table>
                            {{-- <h4>Finance Profile</h4> --}}
                            <div class="col-xs-5">
                                @if($assigned)
                                    @php                              
                                        // print json_encode($feeList);
                                        // print json_encode($fees_assigned);
                                    @endphp
        
                                        @foreach ($sessions as $session) 
                                        <table class="table table-bordered"><span class="border border-dark">
                                            <thead>
                                                <tr>
                                                    <td colspan="4" class="bg-info text-white text-center">{{$feeList[$session]['year']}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col" class="text-center">Session</th>
                                                    <th scope="col" class="text-center">Assigned</th>
                                                    <th scope="col" class="text-center">Paid</th>
                                                    <th scope="col" class="text-center">Remaining</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $total = [
                                                    'assign' => 0,
                                                    'pay' => 0,
                                                    'remain' => 0,
                                                ]; @endphp
                                                @foreach ($feeList[$session]['fee_id'] as $id)
                                                    <tr>
                                                        <th scope="row" class="text-center">{{$type = \App\Fee::find($id)->fee_type->name}}</th>
                                                        <td class="text-center">{{$userSer->numberformat($assign = \App\Fee::find($id)->amount)}}</td>
                                                        @php $payment = $userSer->getPayment($user->id, $session, $id) @endphp
                                                        <td class="text-center">{{$userSer->numberformat($payment)}}</td>
                                                        <td class="text-center">{{$userSer->numberformat($remain = $assign - $payment)}}</td>
                                                        @php
                                                            $total['assign'] += $assign;
                                                            $total['pay'] += $payment;
                                                            $total['remain'] += $remain;
                                                        @endphp
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <strong>
                                                    <th class="text-center">TOTAL</th>
                                                    <td class="text-center">{{$userSer->numberformat($total['assign'])}}</td>
                                                    <td class="text-center">{{$userSer->numberformat($total['pay'])}}</td>
                                                    <td class="text-center">{{$userSer->numberformat($total['remain'])}}</td>
                                                    </strong>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="text-center">
                                                            @component('components.fee-type-form', [
                                                                'buttonTitle' => ($user->studentInfo->assigned)?'Reassign Fees':'Assign Fees',
                                                                'modal_name' => 'assignModal'.$session,
                                                                'title' => 'Assign Fees',
                                                                'put_method' => '',
                                                                'url' => url('fees/reassign'),
                                                            ])
                                                                @slot('buttonType')
                                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#assignModal{{$session}}"><i class="material-icons">assignment_returned</i>  
                                                                @endslot
                                                                @slot('form_content')
                                                                    <input type="hidden" value="{{$user->id}}" name="user_id">
                                                                    <div class="row form-group">
                                                                        <label for="channel" class="col-sm-4 control-label">@lang('Fee Channel')</label>
                                                                        <div class="col-sm-8">
                                                                            <select id="channel" class="form-control" name="channel">
                                                                                @php
                                                                                    $channels[$session] = \App\FeeChannel::where('session',$session)->get();
                                                                                @endphp
                                                                                    <option value="">Select Channel</option>
                                                                                @foreach ($channels[$session] as $channel)
                                                                                    <option value="{{$channel->id}}">{{ucfirst($channel->name)}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        {{-- {{$channels[$session]}} --}}
                                                                    </div>
                                                                    <hr>    
                                                                    <div class="row" id="feeToAssign"></div>
                                                                @endslot
                                                            @endcomponent
                                                        </div>
                                                    </td>
                                                    <td colspan="2">
                                                        <div class="text-center">
                                                            @component('components.fee-type-form', [
                                                                'buttonTitle' => 'Make Payment',
                                                                'modal_name' => 'paymentModal',
                                                                'title' => 'Set Payment '.$session,
                                                                'put_method' => '',
                                                                'url' => url('fees/tct_payment'),
                                                                'size' => 'modal-xl'
                                                            ])
                                                                @slot('buttonType')
                                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#paymentModal"><i class="material-icons">attach_money</i>  
                                                                @endslot
                                                                @slot('form_content')
                                                                    <input type="hidden" value="{{$user->id}}" name="user_id">
                                                                    <input type="hidden" value="{{$session}}" name="session">
                                                                    <div class="row form-group">
                                                                        <label for="channel" class="col-sm-3 control-label">@lang('Fee Channel')</label>
                                                                        <div class="col-sm-5">
                                                                            @php
                                                                                $payValue = ($session == now()->year)? $user->studentInfo->channel->name: \App\Assign::where('session', $session)->where('user_id', $user->id)->first()->fees->fee_type->name;
                                                                            @endphp
                                                                            <input name="fee_channel" class="form-control" value="{{$payValue}}" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <label for="receipt" class="col-sm-3 control-label">@lang('Receipt #')</label>
                                                                        <div class="col-sm-5">
                                                                            <input id = "receipt" name="receipt" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <label for="payment_date" class="col-sm-3 control-label">@lang('Date')</label>
                                                                        <div class="col-sm-4">
                                                                            <input id = "payment_date" name="payment_date" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    @foreach ($feeList[$session]['fee_id'] as $id)
                                                                        @php
                                                                        if($userSer->paymentExists($id, $session)->first()){
                                                                            $text = 1;
                                                                            $assignAm = \App\Fee::find($id)->amount;
                                                                            $paymentAm = $userSer->paymentExists($id, $session)->sum('amount');
                                                                            $remainAm = $assignAm - $paymentAm;
                                                                        } else{ 
                                                                            $text = 0;
                                                                            $remainAm = \App\Fee::find($id)->amount;
                                                                        }
                                                                        @endphp
                                                                        <div class="row form-group">
                                                                            <label for="type" class="col-sm-3 control-label">Fee Type</label>
                                                                            <div class="col-sm-4">
                                                                                <input id = "type" name="typePaid" class="form-control" value="{{\App\Fee::find($id)->fee_type->name}}" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <label for="assigned" class="col-sm-3 control-label">{{($text)?'Remaining':'Assigned'}}</label>
                                                                            <div class="col-sm-4">
                                                                                <input id = "assigned" name="assigned" class="form-control" value="{{$userSer->numberformat($remainAm)}}" readonly>
                                                                            </div>
                                                                        </div>
                                                                        @if($remainAm > 0)
                                                                            <div class="row form-group">
                                                                                <label for="payment{{$id}}" class="col-sm-3 control-label">Payment</label>
                                                                                <div class="col-sm-6">
                                                                                    <input id = "payment{{$id}}" name="payment[{{$id}}]" class="form-control" placeholder="0.00">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row form-group">
                                                                                <label for="notes{{$id}}" class="col-sm-3 control-label">Notes</label>
                                                                                <div class="col-sm-6">
                                                                                    <textarea id = "notes{{$id}}" name="notes[{{$id}}]" class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        <hr>
                                                                    @endforeach
                                                                @endslot
                                                            @endcomponent
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                            </span>
                                        </table>
                                        @endforeach
                                @else
                                    Student has not been assigned! <br>
                                    <br>
                                    @component('components.fee-type-form', [
                                        'buttonTitle' => 'Assign Fees',
                                        'modal_name' => 'assignModal',
                                        'title' => 'Assign Fees',
                                        'put_method' => '',
                                        'url' => url('fees/assign'),
                                    ])
                                        @slot('buttonType')
                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#assignModal"><i class="material-icons">assignment_returned</i>  
                                        @endslot
                                        @slot('form_content')
                                            <input type="hidden" value="{{$user->id}}" name="user_id">
                                            <div class="row form-group">
                                                <label for="channel" class="col-sm-4 control-label">@lang('Fee Channel')</label>
                                                <div class="col-sm-8">
                                                    <select id="channel" class="form-control" name="channel">
                                                        @php
                                                            $channels = \App\FeeChannel::where('session',now()->year)->get();
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

                                @endif
                            </div>
                            <div class="col-xs-5 col-xs-offset-1">
                                @php $allPay = \App\Payment::where('user_id', $user->id)->orderBy('pay_date', 'desc')->get(); @endphp
                                {{-- {{$allPay}} --}}
                                <table class="table">
                                    <thead>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Receipt</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Session</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Edit</th>
                                    </thead>
                                    <tbody>
                                    @foreach($allPay as $pay)
                                        <tr>
                                            <td class="text-center">{{$loop->iteration}}</td>
                                            <td class="text-center">{{$pay->receipt}}</td>
                                            <td class="text-center">{{$pay->fees->fee_type->name}}</td>
                                            <td class="text-right">{{$pay->amount}}</td>
                                            <td class="text-center">{{$pay->session}}</td>
                                            <td class="text-center">{{$pay->pay_date}}</td>
                                            <td class="text-center">
                                                <div class="text-center">
                                                    @component('components.fee-type-form', [
                                                        'buttonTitle' => 'Edit Payment',
                                                        'modal_name' => 'payment'.$pay->id,
                                                        'title' => 'Edit Payment',
                                                        'put_method' => method_field('PUT'),
                                                        'url' => url('fees/tct_payment/'.$pay->id),
                                                    ])
                                                        @slot('buttonType')
                                                            <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#payment{{$pay->id}}"><i class="material-icons">edit</i>  
                                                        @endslot
                                                        @slot('form_content')
                                                            <input type="hidden" value="{{$user->id}}" name="user_id">
                                                            <input type="hidden" value="{{$user->studentInfo->channel_id}}" name="channel_id">
                                                            <div class="row form-group">
                                                                <label for="receipt" class="col-sm-3 control-label">@lang('Receipt #')</label>
                                                                <div class="col-sm-5">
                                                                    <input id = "receipt" name="receipt" class="form-control" value="{{$pay->receipt}}">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label for="payment_date" class="col-sm-3 control-label">@lang('Date')</label>
                                                                <div class="col-sm-4">
                                                                    <input id = "payment_date" name="payment_date" class="form-control"  value="{{$pay->pay_date}}">
                                                                </div>
                                                            </div>
                                                                <div class="row form-group">
                                                                <label for="type" class="col-sm-3 control-label">Fee Type</label>
                                                                <div class="col-sm-4">
                                                                    @php $feeIDs = $feeList[$pay->session]['fee_id']; @endphp
                                                                    {{-- <input id = "type" name="type" class="form-control" value="{{$pay->fees->fee_type->name}}" readonly> --}}
                                                                    <select id="type" class="form-control" name="type">   
                                                                        @foreach ($feeIDs as $feeID)
                                                                            <option value="{{\App\Fee::find($feeID)->fee_type->id}}">{{\App\Fee::find($feeID)->fee_type->name}}</option>
                                                                         @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label for="session" class="col-sm-3 control-label">Session</label>
                                                                <div class="col-sm-4">
                                                                    <input id = "session" name="session" class="form-control" value="{{$pay->session}}">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label for="amount" class="col-sm-3 control-label">Payment</label>
                                                                <div class="col-sm-6">
                                                                    <input id = "amount" name="amount" class="form-control" value="{{$pay->amount}}">
                                                                </div>
                                                            </div>
                                                        @endslot
                                                    @endcomponent
                                                </div>
                                            </td>
                                    {{-- {{$pay}} --}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('jsFiles')
    {{-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> --}}
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function () {
            $('#inactive_date').datepicker({
                format: "yyyy-mm-dd",
            });
            $('#payment_date').datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true,
            });

            $('#birthday').datepicker({
                format: "yyyy-mm-dd",
            });
            $('#session').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });
        });
        // $('#registerBtn').click(function () {
        //     $("#registerForm").submit();
        // });
    </script>

    <script>
        $("#btnPrint").on("click", function () {
        var tableContent = $('#profile-content').html();
        var printWindow = window.open('', '', 'height=720,width=1280');
        printWindow.document.write('<html><head>');
        printWindow.document.write('<link href="{{url('css/app.css')}}" rel="stylesheet">');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<div class="container"><div class="col-md-12" id="academic-part">');
        printWindow.document.write(tableContent);
        printWindow.document.write('</div></div></body></html>');
        printWindow.document.close();
        // var academicPart = printWindow.document.getElementById("academic-part");
        // academicPart.appendChild(resultTable);
        printWindow.print();
        });
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
                    fee_id: $(this).val(),
                },
                success: function(data){
                        $('#feeToAssign').html(data);
                }
            });
            }  
        });
        });
    </script>

