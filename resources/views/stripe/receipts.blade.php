@extends('layouts.app')

@section('title', __('Receipts'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">@lang('Invoices')
              </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <tr>
                            <th>@lang('Charged For')</th>
                            <th>@lang('Payment Date')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Payment Status')</th>
                        </tr>
                        @foreach ($receipts as $receipt)
                            <tr>
                                <td>{{$receipt->charge_for}}</td>
                                <td>{{$receipt->created_at}}</td>
                                <td>{{ $receipt->amount }}</td>
                                <td>{{($receipt->payment_status)?'Paid':'Unpaid'}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
