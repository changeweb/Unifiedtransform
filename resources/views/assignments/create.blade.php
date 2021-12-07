@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-file-post"></i> Create Assignment
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url()->previous()}}">My Courses</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Assignment</li>
                        </ol>
                    </nav>
                    @include('session-messages')

                    <div class="row mt-4">
                        <div class="col-5">
                            <div class="p-3 border bg-light shadow-sm">
                                <form action="{{route('assignment.store')}}" method="POST"  enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                                    <input type="hidden" name="class_id" value="{{request()->query('class_id')}}">
                                    <input type="hidden" name="semester_id" value="{{request()->query('semester_id')}}">
                                    <input type="hidden" name="course_id" value="{{request()->query('course_id')}}">
                                    <input type="hidden" name="section_id" value="{{request()->query('section_id')}}">
                                    <div class="mb-3">
                                        <label for="assignment-name" class="form-label">Assignment Name</label>
                                        <input type="text" class="form-control" id="assignment-name" name="assignment_name" placeholder="Assignment Name" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="assignment-file" class="form-label">Assignment File</label>
                                        <input type="file" name="file" class="form-control" id="assignment-file" accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip" required>
                                    </div>
                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-check2"></i> Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
