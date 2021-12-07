@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-journal-medical"></i> Syllabus
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url()->previous()}}">Courses</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Syllabus</li>
                        </ol>
                    </nav>
                    <div class="mb-4 mt-4">
                        <div class="p-3 mt-3 bg-white border shadow-sm">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Syllabus Name</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($syllabi as $syllabus)
                                        <tr>
                                            <td>{{$syllabus->syllabus_name}}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{asset('storage/'.$syllabus->syllabus_file_path)}}" role="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i> Download</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
