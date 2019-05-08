@extends('layouts.app')

@section('title', 'All Books')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default">
                    <div class="page-panel-title">Books</div>

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
                                        <th>Title</th>
                                        <th>Code</th>
                                        <th>Author</th>
                                        <th>Type</th>
                                        <th>Quantity</th>
                                        <th>Actions</th>
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
                                                        Details
                                                    </a>
                                                </div>
                                                <div class="btn-group">
                                                    <a href="{{ route('library.books.edit', $book->id) }}" class="btn btn-xs btn-success">
                                                        Edit
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
