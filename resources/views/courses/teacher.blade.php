@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-journal-medical"></i> My Courses
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My courses</li>
                        </ol>
                    </nav>
                    <h6>Filter list by:</h6>
                    <div class="mb-4 mt-4">
                        <form action="{{route('course.teacher.list.show')}}" method="GET">
                            <input type="hidden" name="teacher_id" value="{{Auth::user()->id}}">
                            <div class="row">
                                <div class="col">
                                    <select class="form-select" aria-label=".form-select-sm" name="semester_id" required>
                                        @isset($semesters)
                                            @foreach ($semesters as $semester)
                                            <option value="{{$semester->id}}" {{($semester->id === request()->query('semester_id'))?'selected':''}}>{{$semester->semester_name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-counterclockwise"></i> Load List</button>
                                </div>
                            </div>
                        </form>
                        <div class="p-3 mt-3 bg-white border shadow-sm">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Course Name</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Section</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($courses)
                                        @foreach ($courses as $course)
                                        <tr>
                                            <td>{{$course->course->course_name}}</td>
                                            <td>{{$course->schoolClass->class_name}}</td>
                                            <td>{{$course->section->section_name}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                      Action
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                      <li><a href="{{route('attendance.create.show', [
                                                        'class_id' => $course->schoolClass->id,
                                                        'section_id' => $course->section->id,
                                                        'course_id' => $course->course->id,
                                                        'class_name' => $course->schoolClass->class_name,
                                                        'section_name' => $course->section->section_name,
                                                        'course_name' => $course->course->course_name
                                                    ])}}" role="button" class="dropdown-item"><i class="bi bi-calendar2-week me-2"></i> Take Attendance</a></li>
                                                      <li><a href="{{route('attendance.list.show', [
                                                        'class_id' => $course->schoolClass->id,
                                                        'section_id' => $course->section->id,
                                                        'course_id' => $course->course->id,
                                                        'class_name' => $course->schoolClass->class_name,
                                                        'section_name' => $course->section->section_name,
                                                        'course_name' => $course->course->course_name
                                                    ])}}" role="button" class="dropdown-item"><i class="bi bi-calendar2-week-fill me-2"></i> View Attendance</a></li>
                                                    <li><a href="{{route('course.syllabus.index', ['course_id' => $course->course->id])}}" role="button" class="dropdown-item"><i class="bi bi-journal-text me-2"></i> View Syllabus</a></li>
                                                      <li><a href="{{route('assignment.create', [
                                                        'class_id' => $course->schoolClass->id,
                                                        'section_id' => $course->section->id,
                                                        'course_id' => $course->course->id,
                                                        'semester_id' => request()->query('semester_id')
                                                    ])}}" role="button" class="dropdown-item"><i class="bi bi-file-post me-2"></i> Create Assignment</a></li>
                                                      <li><a href="{{route('assignment.list.show', ['course_id' => $course->course->id])}}" role="button" class="dropdown-item"><i class="bi bi-file-post-fill me-2"></i> View Assignments</a></li>
                                                      <li><a href="{{route('course.mark.create', [
                                                        'class_id' => $course->schoolClass->id,
                                                        'class_name' => $course->schoolClass->class_name,
                                                        'section_id' => $course->section->id,
                                                        'section_name' => $course->section->section_name,
                                                        'course_id' => $course->course->id,
                                                        'course_name' => $course->course->course_name,
                                                        'semester_id' => $selected_semester_id
                                                    ])}}" role="button" class="dropdown-item"><i class="bi bi-input-cursor me-2"></i> Give Marks</a></li>
                                                    <li><a href="{{route('course.mark.list.show', [
                                                        'class_id' => $course->schoolClass->id,
                                                        'class_name' => $course->schoolClass->class_name,
                                                        'section_id' => $course->section->id,
                                                        'section_name' => $course->section->section_name,
                                                        'course_id' => $course->course->id,
                                                        'course_name' => $course->course->course_name,
                                                        'semester_id' => $selected_semester_id
                                                    ])}}" role="button" class="dropdown-item"><i class="bi bi-cloud-sun me-2"></i> View Final Results</a></li>
                                                    <li><a href="#" role="button" class="dropdown-item disabled"  tabindex="-1" aria-disabled="true"><i class="bi bi-chat-left-text me-2"></i> Message Students</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endisset
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
