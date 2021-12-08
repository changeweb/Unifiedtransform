@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3"><i class="bi bi-plus"></i> Create Routine</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Routine</li>
                        </ol>
                    </nav>
                    @include('session-messages')
                    <div class="row">
                        <div class="col-md-5 mb-4">
                            <div class="p-3 border bg-light shadow-sm">
                                <form action="{{route('section.routine.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                                    <div>
                                        <p class="mt-2">Select class:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                        <select onchange="getSectionsAndCourses(this);" class="form-select" name="class_id" required>
                                            @isset($classes)
                                                <option selected disabled>Please select a class</option>
                                                @foreach ($classes as $school_class)
                                                <option value="{{$school_class->id}}">{{$school_class->class_name}}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <div>
                                        <p class="mt-2">Select section:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                        <select class="form-select" id="section-select" name="section_id" required>
                                        </select>
                                    </div>
                                    <div>
                                        <p class="mt-2">Select course:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                        <select class="form-select" id="course-select" name="course_id" required>
                                        </select>
                                    </div>
                                    <div class="mt-2">
                                        <p>Week Day<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                        <select class="form-select" id="course-select" name="weekday" required>
                                            <option value="1">Monday</option>
                                            <option value="2">Tuesday</option>
                                            <option value="3">Wednesday</option>
                                            <option value="4">Thursday</option>
                                            <option value="5">Friday</option>
                                            <option value="6">Saturday</option>
                                            <option value="7">Sunday</option>
                                        </select>
                                    </div>
                                    <div class="mt-2">
                                        <label for="inputStarts" class="form-label">Starts<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                        <input type="text" class="form-control" id="inputStarts" name="start" placeholder="09:00am" required>
                                    </div>
                                    <div class="mt-2">
                                        <label for="inputEnds" class="form-label">Ends<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                        <input type="text" class="form-control" id="inputEnds" name="end" placeholder="09:50am" required>
                                    </div>
                                    <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="bi bi-check2"></i> Create</button>
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
<script>
    function getSectionsAndCourses(obj) {
        var class_id = obj.options[obj.selectedIndex].value;

        var url = "{{route('get.sections.courses.by.classId')}}?class_id=" + class_id 

        fetch(url)
        .then((resp) => resp.json())
        .then(function(data) {
            var sectionSelect = document.getElementById('section-select');
            sectionSelect.options.length = 0;
            data.sections.unshift({'id': 0,'section_name': 'Please select a section'})
            data.sections.forEach(function(section, key) {
                sectionSelect[key] = new Option(section.section_name, section.id);
            });

            var courseSelect = document.getElementById('course-select');
            courseSelect.options.length = 0;
            data.courses.unshift({'id': 0,'course_name': 'Please select a course'})
            data.courses.forEach(function(course, key) {
                courseSelect[key] = new Option(course.course_name, course.id);
            });
        })
        .catch(function(error) {
            console.log(error);
        });
    }
</script>
@endsection
