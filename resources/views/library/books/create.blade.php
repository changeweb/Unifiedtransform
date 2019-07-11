@extends('layouts.app')

@section('title', __('Add New Book'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-8" id="main-container">
                <div class="panel panel-default">
                    <div class="page-panel-title">@lang('Add New Book')</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('library.books.store') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            @include('library.books.form')

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button type="submit" class="btn btn-danger">@lang('Save')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
