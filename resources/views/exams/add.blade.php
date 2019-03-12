@extends('layouts.app')
@section('title', 'Add Examination')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-8" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">Add Examination</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.add-exam-form',['classes'=>$classes])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
