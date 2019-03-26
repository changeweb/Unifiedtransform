@extends('layouts.app')
@section('title', 'All Issued Book')
@section('content')
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">All Issued Book</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.issued-books-list',['books'=>$issued_books])
                    @endcomponent
                </div>
            </div>
        </div>
@endsection
