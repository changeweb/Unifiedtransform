@extends('layouts.app')
@section('title', 'Add New Book')
@section('content')
        <div class="col-md-8" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">Add New Book</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.add-book-form',['classes'=>$classes])
                    @endcomponent
                </div>
            </div>
        </div>
@endsection
