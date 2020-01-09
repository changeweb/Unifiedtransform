<table class="table table-condensed">
    <thead>
        <th><h4>{{$feeList[$session]['year']}}</h4></th>
        @foreach($feeList[$session]['types'] as $fee_type)
            <th class="text-center">{{$fee_type}}</th>
        @endforeach
        <th class="text-center">Action</th>
    </thead>
    <tbody>
        <tr>
            <td>{{($feeList[$session]['types'])?'Assigned':'Not Assigned'}}</td>
            @foreach ($feeList[$session]['fee_id'] as $id)
                <td class=text-right>{{\App\Fee::find($id)->amount}}</td>                                        
            @endforeach
            <td>
                    <!-- ASSIGN BUTTON -->
                <div class="text-center">
                    @component('components.fee-type-form', [
                        'buttonTitle' => ($user->studentInfo->assigned)?'Reassign Fees':'Assign Fees',
                        'modal_name' => 'assignModal'.$session,
                        'title' => 'Assign Fees',
                        'put_method' => '',
                        'url' => url('fees/assign'),
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
        </tr>
        <tr>
            <td>Payment</td>
            @foreach($feeList[$session]['fee_id'] as $id)
                @if($payments->where('fee_id', $id)->first())
                    <td class="text-right">{{$userSer->getPayment($user->id, $session, $id, 1)}}</td>
                @else
                    <td  class="text-right">-</td>
                @endif
            @endforeach
            <td>
                <!-- PAYMENT BUTTON -->
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
                                <div class="row form-group">
                                    <label for="type" class="col-sm-4 control-label">Fee Type</label>
                                    <div class="col-sm-4">
                                        <input id = "type" name="typePaid" class="form-control" value="{{\App\Fee::find($id)->fee_type->name}}" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label for="assigned" class="col-sm-3 control-label">Assigned</label>
                                    <div class="col-sm-4">
                                        <input id = "assigned" name="assigned" class="form-control" value="{{App\Fee::find($id)->amount}}" readonly>
                                    </div>
                                </div>
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
                                <hr>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
            </td>
        </tr>   
        <tr>
            <td><strong>Remaining</strong></td>
            @php
                $remainArr = [];
            @endphp
            @foreach($feeList[$session]['fee_id'] as $id)
                @php
                    // $assign = \App\Fee::find($id)->amount;
                    // $paid = $payments->where('fee_id', $id)->sum('amount');
                @endphp
                    <td class="text-right">{{$userSer->getRemainFromID($payments, $id, 1)}}</td>
            @endforeach
</table>