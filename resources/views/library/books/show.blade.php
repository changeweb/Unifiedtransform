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
                    <div class="page-panel-title">Book Details</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Book Code</th>
                                    <td>{{ $book->book_code }}</td>
                                    <th>Book Title</th>
                                    <td>{{ $book->title }}</td>
                                    <th>Author</th>
                                    <td>{{ $book->author }}</td>
                                    <th>About</th>
                                    <td>{{ $book->about }}</td>
                                </tr>
                                <tr>
                                    <th>Quantity</th>
                                    <td>{{ $book->quantity }}</td>
                                    <th>Rack No</th>
                                    <td>{{ $book->rackNo }}</td>
                                    <th>row No</th>
                                    <td>{{ $book->rowNo }}</td>
                                    <th>Type</th>
                                    <td>{{ $book->type }}</td>
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        <img src="{{ $book->img_path }}" alt="{{ $book->title }}" />
                                    </td>
                                    <th>Price</th>
                                    <td>{{ $book->price }}</td>
                                    <th>Class</th>
                                    <td>{{ $book->class->class_number }}</td>
                                    <th>School</th>
                                    <td>{{ $book->school->name }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $book->created_at }}</td>
                                    <th>Updated At</th>
                                    <td>{{ $book->updated_at }}</td>
                                    <th>Registered By</th>
                                    <td>{{ $book->user->name }}</td>
                                </tr>
                            </thead>
                        </table>

                    </div>
                    <div class="row">
                        <a href="{{ route('library.books.index') }}" class="btn btn-xs btn-primary">all books</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
