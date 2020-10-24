@extends('layouts.app')

@section('title', __('All Books'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default">
                    <div class="page-panel-title">@lang('Books')</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ $books->links() }}
                        <div class="table-responsive">
                            <table class="table table-bordered table-data-div table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('Title')</th>
                                        <th>@lang('Code')</th>
                                        <th>@lang('Author')</th>
                                        <th>@lang('Type')</th>
                                        <th>@lang('Quantity')</th>
                                        <th>@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $book)
                                        <tr>
                                            <td>{{ ($loop->index + 1) }}</td>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->book_code }}</td>
                                            <td>{{ $book->author }}</td>
                                            <td>{{ $book->type }}</td>
                                            <td>{{ $book->quantity }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('library.books.show', $book->id) }}" class="btn btn-xs btn-info">
                                                        @lang('Details')
                                                    </a>
                                                </div>
                                                <div class="btn-group">
                                                    <a href="{{ route('library.books.edit', $book->id) }}" class="btn btn-xs btn-success">
                                                        @lang('Edit')
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
