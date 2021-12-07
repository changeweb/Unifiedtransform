@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-cloud-sun"></i> Course Marks
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url()->previous()}}">My Courses</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Course Marks</li>
                        </ol>
                    </nav>
                    <h5>Course: {{$course_name}}</h5>
                    <div class="mb-4 mt-4 p-3 bg-white border shadow-sm">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Exam Name</th>
                                    <th scope="col">Marks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($marks as $mark)
                                    <tr>
                                        <td>{{$mark->exam->exam_name}}</td>
                                        <td>{{$mark->marks}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if(count($final_marks) > 0)
                    <h5>Final Result</h5>
                    <div class="bg-white border mt-4 p-3 shadow-sm">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Total Marks</th>
                                    <th scope="col">Grade Points</th>
                                    <th scope="col">Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($final_marks)
                                    @foreach ($final_marks as $mark)
                                    <tr>
                                        <td>{{$mark->final_marks}}</td>
                                        <td>{{$mark->getAttribute('point')}}</td>
                                        <td>{{$mark->getAttribute('grade')}}</td>
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
