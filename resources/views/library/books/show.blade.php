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
                    <div class="page-panel-title">@lang('Book Details')</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>@lang('Book Code')</th>
                                    <td>{{ $book->book_code }}</td>
                                    <th>@lang('Book Title')</th>
                                    <td>{{ $book->title }}</td>
                                    <th>@lang('Author')</th>
                                    <td>{{ $book->author }}</td>
                                    <th>@lang('About')</th>
                                    <td>{{ $book->about }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Quantity')</th>
                                    <td>{{ $book->quantity }}</td>
                                    <th>@lang('Rack No')</th>
                                    <td>{{ $book->rackNo }}</td>
                                    <th>@lang('row No')</th>
                                    <td>{{ $book->rowNo }}</td>
                                    <th>@lang('Type')</th>
                                    <td>{{ $book->type }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Image')</th>
                                    <td>
                                        <img src="{{ $book->img_path }}" alt="{{ $book->title }}" />
                                    </td>
                                    <th>@lang('Price')</th>
                                    <td>{{ $book->price }}</td>
                                    <th>@lang('Class')</th>
                                    <td>{{ $book->class->class_number }}</td>
                                    <th>@lang('School')</th>
                                    <td>{{ $book->school->name }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Created At')</th>
                                    <td>{{ $book->created_at }}</td>
                                    <th>@lang('Updated At')</th>
                                    <td>{{ $book->updated_at }}</td>
                                    <th>@lang('Registered By')</th>
                                    <td>{{ $book->user->name }}</td>
                                </tr>
                            </thead>
                        </table>

                    </div>
                    <div class="row">
                        <a href="{{ route('library.books.index') }}" class="btn btn-xs btn-primary">@lang('all books')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
