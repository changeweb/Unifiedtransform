@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="page-panel-title">Dashboard</div>

                <div class="panel-body">
                    <a class="btn btn-danger btn-lg btn-block" href="{{ route('shools.index') }}" role="button">Manage Schools</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
