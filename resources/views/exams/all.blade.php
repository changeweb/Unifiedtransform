@extends('layouts.app')
@section('title', 'All Examinations')
@section('content')
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">All Examinations</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.exams-list',['exams'=>$exams])
                    @endcomponent
                </div>
            </div>
        </div>
@endsection
