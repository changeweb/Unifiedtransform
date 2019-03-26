@extends('layouts.app')
@section('title', 'Issue Book')
@section('content')
        <div class="col-md-8" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">Issue books</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.book-issue-form',['books'=>$books])
                    @endcomponent
                </div>
            </div>
        </div>
@endsection
