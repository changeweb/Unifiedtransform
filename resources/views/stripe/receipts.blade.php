@extends('layouts.app')

@section('title', 'Receipts')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">Invoices
              </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <tr>
                            <th>Charged For</th>
                            <th>Payment Date</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
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
