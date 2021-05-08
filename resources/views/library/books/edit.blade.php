@extends('layouts.app')

@section('title', __('Edit Book'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-8" id="main-container">
                <div class="panel panel-default">
                    <div class="page-panel-title">@lang('Edit Book Info')</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ url('library/books', $book->id) }}" method="POST" class="form-horizontal">

                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include('library.books.form', $book)

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button type="submit" class="btn btn-danger">@lang('Update Book Info')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
