@extends('layouts.app')
@section('title', 'All Books')
@section('content')
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">All Books</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.all-books',['books'=>$books])
                    @endcomponent
                </div>
            </div>
        </div>
@endsection
