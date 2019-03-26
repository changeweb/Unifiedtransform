@extends('layouts.app')
@section('title', 'All Active Examinations')
@section('content')
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">All Active Examinations</div>

                <div class="panel-body">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @if(count($exams) > 0)
                        @foreach($exams as $exam)
                            @component('components.active-exams',['exam'=>$exam,'courses'=>$courses])
                            @endcomponent
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
@endsection
