@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="page-panel-title">@lang('Dashboard')</div>

                <div class="panel-body">
                    <a class="btn btn-danger btn-lg btn-block" href="{{ route('schools.index') }}" role="button">
                        @lang('Manage Schools')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
